<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingsToEbay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->integer('send_to_ebay_days')->nullable();
            $table->integer('send_to_ebay_markup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('send_to_ebay_days');
        });
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('send_to_ebay_markup');
        });
    }
}
