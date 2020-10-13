<?php

use App\Wax\Shop\Models\Product\Customization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductCustomizationForOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Customization::create([
            'id' => 2,
            'product_id' => 1,
            'required' => 0,
            'name' => 'offer_id',
            'type' => 'number',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('product_customizations')
            ->where('id', 2)
            ->delete();
    }
}
