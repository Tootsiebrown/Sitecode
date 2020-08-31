<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showCart()
    {
        return view('shop.cart.cart');
    }
}
