<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListItemsIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_items', function (Blueprint $table) {
            $table->index(['listing_id', 'order_item_id', 'reserved_for_order_id'], 'listing_order_item_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_items', function (Blueprint $table) {
            $table->dropIndex('listing_order_item_order');
        });
    }
}
