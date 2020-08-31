<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipmentCanBePickupInStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_shipments', function (Blueprint $table) {
            $table->boolean('in_store_pickup')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_shipments', function (Blueprint $table) {
            $table->dropColumn('in_store_pickup');
        });
    }
}
