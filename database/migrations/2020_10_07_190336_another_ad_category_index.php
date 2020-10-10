<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnotherAdCategoryIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_category_links', function (Blueprint $table) {
            $table->index(['category_id', 'ad_id'], 'category_ad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_category_links', function (Blueprint $table) {
            $table->dropIndex('category_ad');
        });
    }
}
