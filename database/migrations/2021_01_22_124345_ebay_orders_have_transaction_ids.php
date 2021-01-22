<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EbayOrdersHaveTransactionIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebay_orders', function (Blueprint $table) {
            $table->dropUnique('ebay_orders_ebay_id');

            $table->string('ebay_id')->nullable()->change();
            $table->string('transaction_id')->nullable();

            $table->unique(['ebay_id', 'transaction_id'], 'ebay_orders_id_transaction_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // won't really work in reverse.
    }
}
