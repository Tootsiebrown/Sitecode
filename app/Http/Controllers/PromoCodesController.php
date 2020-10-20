<?php

namespace App\Http\Controllers;

use Wax\Shop\Models\Coupon;

class PromoCodesController extends Controller
{
    public function index()
    {
        return view('dashboard.promo-codes.index', ['coupons' => Coupon::paginate(20)]);
    }

    public function create()
    {
        $coupon = new Coupon();

        return view('dashboard.promo-codes.details', [
            'coupon' => $coupon,
            'method' => 'POST',
            'action' => route('dashboard.promoCodes.store'),
        ]);
    }
}
