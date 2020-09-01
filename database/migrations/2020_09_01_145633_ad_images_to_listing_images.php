<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdImagesToListingImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('ad_images', 'listing_images');

        Schema::table('listing_images', function(Blueprint $table) {
            $table->renameColumn('ad_id', 'listing_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('listing_images', 'ad_images');

        Schema::table('ad_images', function(Blueprint $table) {
            $table->renameColumn('listing_id', 'ad_id');
        });
    }
}
