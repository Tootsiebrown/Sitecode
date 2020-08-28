<?php

use App\Ad;
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
        Ad::where('type', 'buy-it-now')
            ->update(['type' => 'set-price']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Ad::where('type', 'set-price')
            ->update(['type' => 'buy-it-now']);
    }
}
