<?php

use App\Wax\Shop\Models\Product;
use App\Wax\Shop\Models\Product\Customization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $product = Product::create([
            'id' => 1,
            'name' => 'Ad',
            'sku' => 'ad',
            'description' => '',
            'short_description' => '',
        ]);

        Customization::create([
            'id' => 1,
            'product_id' => 1,
            'name' => 'ad_id',
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
        $product = Product::find(1);
        $product->customizations->delete();
        $product->delete();
    }
}
