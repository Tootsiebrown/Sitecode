<?php

use App\Models\Listing;
use Illuminate\Database\Migrations\Migration;

class BuyItNowToSetPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Listing::where('type', 'buy-it-now')
            ->update(['type' => 'set-price']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Listing::where('type', 'set-price')
            ->update(['type' => 'buy-it-now']);
    }
}
