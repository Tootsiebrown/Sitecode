<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingsEbaySendAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('send_to_ebay_days');
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->dateTime('send_to_ebay_at')->nullable();
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
            $table->dropColumn('send_to_ebay_at');
            $table->integer('send_to_ebay_days')->nullable();
        });
    }
}
