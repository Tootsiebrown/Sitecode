<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingItemsHaveEbayOrderId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_items', function (Blueprint $table) {
            $table->integer('ebay_order_id')->unsigned()->nullable();
        });

        Schema::table('listing_items', function (Blueprint $table) {
            $table->dropIndex('listing_item_order_reservations');
            $table->index(
                ['listing_id', 'order_item_id', 'reserved_for_offer_id', 'reserved_for_order_id', 'ebay_order_id'],
                'listing_item_order_reservations'
            );
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
            $table->dropColumn('ebay_order_id');
        });

        Schema::table('listing_items', function (Blueprint $table) {
            $table->dropIndex('listing_item_order_reservations');
            $table->index(
                ['listing_id', 'order_item_id', 'reserved_for_offer_id', 'reserved_for_order_id'],
                'listing_item_order_reservations'
            );
        });
    }
}
