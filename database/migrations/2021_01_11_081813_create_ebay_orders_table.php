<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbayOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebay_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('ebay_id');

            $table->unique('ebay_id', 'ebay_orders_ebay_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebay_orders');
    }
}
