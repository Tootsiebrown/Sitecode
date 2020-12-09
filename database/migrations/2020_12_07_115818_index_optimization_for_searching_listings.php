<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IndexOptimizationForSearchingListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_items', function (Blueprint $table) {
            $table->dropIndex('listing_order_item_order');
            $table->index(
                ['listing_id', 'order_item_id', 'reserved_for_offer_id', 'reserved_for_order_id'],
                'listing_item_order_reservations'
            );
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->index(['type', 'expired_at', 'secret'], 'listings_type_expired_secret');
            $table->dropIndex('listings_type_expired_at');
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
            $table->index(
                ['listing_id', 'order_item_id', 'reserved_for_order_id'],
                'listing_order_item_order'
            );
            $table->dropIndex('listing_item_order_reservations');
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->index(['type', 'expired_at'], 'listings_type_expired_at');
        });
    }
}
