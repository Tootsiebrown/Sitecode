<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Rules\AuctionIsPayable;
use App\Rules\AuctionWonByCurrentUser;
use App\Rules\OfferIsPayable;
use App\Rules\OfferMine;
use App\Rules\OfferNotYetInCart;
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
                    'exists:listings',
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

        return redirect()->route('shop.checkout.start');
    }

    public function acceptedOffer(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => [
                    'exists:offers',
                    new OfferMine(),
                    new OfferIsPayable(),
                    new OfferNotYetInCart(),
                    'required',
                ],
            ]
        );

        $offer = Offer::find($request->input('id'));

        $customizations = [
            1 => $offer->listing_id,
            2 => $request->input('id'),
        ];

        if (! ShopServiceFacade::getActiveOrder()->default_shipment->findItem(1, [], $customizations)) {
            ShopServiceFacade::addOrderItem(
                1,
                $offer->counter_quantity ?? $offer->auantity,
                [],
                $customizations
            );
        }

        return redirect()->route('shop.checkout.start');
    }
}
