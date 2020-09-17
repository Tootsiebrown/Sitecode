<?php

namespace App\Http\Controllers;

use App\Rules\AuctionIsPayable;
use App\Rules\AuctionWonByCurrentUser;
use Illuminate\Http\Request;
use Wax\Shop\Facades\ShopServiceFacade;

class PayForItController extends Controller
{
    public function endedAuction(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => [
                    'exists:ads',
                    new AuctionWonByCurrentUser(),
                    new AuctionIsPayable(),
                    'required',
                ],
            ]
        );

        $customizations = [1 => $request->input('id')];

        if (! ShopServiceFacade::getActiveOrder()->default_shipment->findItem(1, [], $customizations)) {
            ShopServiceFacade::addOrderItem(1, 1, [], $customizations);
        }

        return redirect()->route('shop.checkout');
    }
}
