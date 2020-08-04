<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanupProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('is_feature');
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('storage');
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('ref');
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->boolean('featured')->default(false);
            $table->string('disk')->default('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_images', function(Blueprint $table) {
            $table->enum('type', ['image', 'file'])->nullable()->default(null);
            $table->enum('is_feature', [0, 1])->nullable()->default(null);
            $table->enum('storage', ['local', 'public', 's3'])->nullable()->default(null);
            $table->string('ref')->nullable()->default(null);
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('featured');
        });

        Schema::table('product_images', function(Blueprint $table) {
            $table->dropColumn('disk');
        });
    }
}
