<?php

namespace App\Console\Commands;

use App\Models\Brand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DedupBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catch:dedup-brands {--show} {--dry-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deduplicate categories. Assign listings/products to the canonical brand.';

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
        $duplicatedBrands = Db::table('brands')
            ->select('name', DB::raw('count("id") as count'))
            ->groupBy('name')
            ->having('count', '>', 1)
            ->orderBy('count', 'desc')
            ->get()
            ->map(fn($brand) => ['name' => $brand->name, 'count' => $brand->count]);

        if ($this->option('show')) {
            $this->table(
                ['brand', 'count'],
                $duplicatedBrands,
            );
        }

        if ($this->option('dry-run')) {
            return;
        }

        $duplicatedBrands->each(function ($brand) {
            $brands = Brand::with('listings', 'products')
                ->where('name', 'like', $brand['name'])
                ->get();

            $brandsMap = $brands
                ->sort(function ($brand1, $brand2) {
                    return ($brand2->listings->count() + $brand2->products->count())
                        <=> ($brand1->listings->count() + $brand1->products->count());
                });

            $canonicalBrand = $brandsMap->first();

            $brandsMap->each(function ($brand) use ($canonicalBrand) {
                if ($brand->id === $canonicalBrand) {
                    return;
                }

                $brand->listings()->withoutGlobalScopes()->update([
                    'brand_id' => $canonicalBrand->id
                ]);

                $brand->products()->update([
                    'brand_id' => $canonicalBrand->id
                ]);

                $brand->delete();
            });
        });
    }
}
