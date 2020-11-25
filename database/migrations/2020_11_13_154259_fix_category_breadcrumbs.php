<?php

use App\ProductCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCategoryBreadcrumbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ProductCategory::where('parent_id', 0)
            ->orWhereNull('breadcrumb')
            ->get()
            ->each(function ($category) {
                $category->regenerateBreadcrumb();
                $category->regenerateChildrenBreadcrumbs();
            });

        ProductCategory::all()
            ->each(function ($category) {
                if (is_null($category->parent) && $category->parent_id !== 0) {
                    $category->delete();
                }
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
