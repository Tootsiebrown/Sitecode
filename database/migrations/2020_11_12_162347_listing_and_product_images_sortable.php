<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingAndProductImagesSortable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_images', function (Blueprint $table) {
            $table->integer('sort_id')->unsigned()->nullable();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->integer('sort_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('listing_images', function (Blueprint $table) {
            $table->dropColumn('sort_id');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('sort_id');
        });
    }
}
