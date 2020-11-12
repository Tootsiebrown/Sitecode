<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CopyProductImagesToListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (App::environment() == 'testing') {
            return;
        }

        (new \Illuminate\Filesystem\Filesystem())->copyDirectory(
            Storage::disk('public')->path(\App\ProductImage::getDiskPath()),
            Storage::disk('public')->path(\App\Models\Listing\Image::getDiskPath())
        );
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
