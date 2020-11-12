<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProdictAndListingImagesHaveMetadata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_images', function ($table) {
            $table->text('metadata')->default('');
        });
        Schema::table('listing_images', function ($table) {
            $table->text('metadata')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_images', function ($table) {
            $table->dropColumn('metadata');
        });
        Schema::table('listing_images', function ($table) {
            $table->dropColumn('metadata');
        });
    }
}
