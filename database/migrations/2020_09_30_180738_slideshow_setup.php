<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SlideshowSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('carousel', 'slides');

        Schema::table('slides', function (Blueprint $table) {
            $table->string('background_image')->nullable();
            $table->text('background_image_metadata')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('background_image');
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('background_image_metadata');
        });

        Schema::rename('slides', 'carousel');
    }
}
