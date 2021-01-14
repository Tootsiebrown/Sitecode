<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EbayOrdersCancelable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebay_orders', function (Blueprint $table) {
            $table->integer('canceled_by_user_id')->unsigned()->nullable();
            $table->dateTime('canceled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebay_orders', function (Blueprint $table) {
            $table->dropColumn('canceled_by_user_id');
        });

        Schema::table('ebay_orders', function (Blueprint $table) {
            $table->dropColumn('canceled_at');
        });
    }
}
