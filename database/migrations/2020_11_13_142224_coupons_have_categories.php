<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CouponsHaveCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
        });

        Schema::table('order_coupons', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });

        Schema::table('order_coupons', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
