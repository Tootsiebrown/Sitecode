<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Category;
use App\Models\ProductCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DedupCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catch:dedup-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deduplicate categories. Assign listings/products to the canonical category.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cleanupDuplicatedChildrenOf(0);
        ProductCategory::top()
            ->get()
            ->each(function ($category) {
                $this->cleanupDuplicatedChildrenOf($category->id);
                $category
                    ->children
                    ->each(function ($category) {
                        $this->cleanupDuplicatedChildrenOf($category->id);
                        $category
                            ->children
                            ->each(function ($category) {
                                $this->cleanupDuplicatedChildrenOf($category->id);
                            });
                    });
            });
    }

    protected function cleanupDuplicatedChildrenOf($parentId)
    {
        $duplicatedCategories = Db::table('product_categories')
            ->where('parent_id', $parentId)
            ->select('name', DB::raw('count("id") as count'))
            ->groupBy('name')
            ->having('count', '>', 1)
            ->orderBy('count', 'desc')
            ->get()
            ->map(fn($category) => ['name' => $category->name, 'count' => $category->count]);

        $duplicatedCategories->each(function ($category) {
            $categories = ProductCategory::with('listings', 'products')
                ->where('name', 'like', $category['name'])
                ->get();

            $categoriesMap = $categories
                ->sort(function ($category1, $category2) {
                    return ($category2->children->count())
                        <=> ($category1->children->count());
                });

            $canonicalCategory = $categoriesMap->first();

            $categoriesMap->each(function ($category) use ($canonicalCategory) {
                if ($category->id === $canonicalCategory->id) {
                    return;
                }

                $this->moveListings($category->listings()->withoutGlobalScopes()->get(), $category->id, $canonicalCategory->id);
                $this->moveProducts($category->products, $category->id, $canonicalCategory->id);
                $this->moveChildren($category->children, $canonicalCategory->id);

                $category->delete();
            });

            $this->cleanupDuplicatedChildrenOf($canonicalCategory->id);
        });
    }

    protected function moveListings($listings, $fromId, $toId)
    {
        Db::table('ad_category_links')
            ->whereIn('ad_id', $listings->pluck('id'))
            ->where('category_id', $fromId)
            ->update(['category_id' => $toId]);
    }

    protected function moveProducts($products, $fromId, $toId)
    {
        Db::table('product_category_links')
            ->whereIn('product_id', $products->pluck('id'))
            ->where('category_id', $fromId)
            ->update(['category_id' => $toId]);
    }

    public function moveChildren($children, $canonicalCategoryId)
    {
        Db::table('product_categories')
            ->whereIn('id', $children->pluck('id'))
            ->update(['parent_id' => $canonicalCategoryId]);
    }
}
