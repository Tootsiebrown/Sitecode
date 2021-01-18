<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbayAspectsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_ebay_aspects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->string('name');
            $table->string('cardinality');
        });

        Schema::create('listing_ebay_aspect_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aspect_id')->unsigned();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_ebay_aspects');
        Schema::dropIfExists('listing_ebay_aspect_values');
    }
}
