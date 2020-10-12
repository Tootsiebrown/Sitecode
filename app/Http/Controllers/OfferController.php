<?php

namespace App\Http\Controllers;

use App\Mail\OfferAccepted;
use App\Mail\OfferCountered;
use App\Mail\OfferRejected;
use App\Mail\OfferSubmitted;
use App\Models\Listing;
use App\Models\Offer;
use App\Rules\ListingGteInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    public function make(Request $request)
    {
        $listing = Listing::findOrFail($request->input('listing_id'));

        $this->validate(
            $request,
            [
                'offer_quantity' => [
                    'required',
                    'numeric',
                    'min:1',
                    new ListingGteInventory($listing),
                ],
                'offer_price' => 'required|numeric|min:1'
            ]
        );

        $offer = Offer::create([
            'user_id' => Auth::user()->id,
            'quantity' => $request->input('offer_quantity'),
            'price' => $request->input('offer_price'),
            'listing_id' => $listing->id,
        ]);

        Mail::to(config('wax.shop.offersToEmail'))
            ->queue(new OfferSubmitted(
                $offer,
                $listing,
                $request->input('offer_quantity'),
                $request->input('offer_price'),
                Auth::user(),
            ));

        return redirect()
            ->back()
            ->with('success', 'Offer received. We‘ll get back with you shortly!');
    }

    public function index()
    {
        $offers = Offer::with('listing')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('dashboard.offers.index', ['offers' => $offers]);
    }

    public function show($id)
    {
        $offer = Offer::find($id);

        return view('dashboard.offers.details', [
            'offer' => $offer
        ]);
    }

    public function accept($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->accept();

        Mail::queue(new OfferAccepted($offer));

        return redirect()
            ->back()
            ->with('success', 'Offer accepted');
    }

    public function reject($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->reject();

        Mail::queue(new OfferRejected($offer));

        return redirect()
            ->back()
            ->with('success', 'Offer rejected');
    }

    public function counter(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $this->validate(
            $request,
            [
                'counter_price' => 'required|numeric|min:1',
                'counter_quantity' => 'required|numeric|min:1'
            ]
        );

        $offer->counter($request->all());

        Mail::queue(new OfferCountered($offer));

        return redirect()
            ->back()
            ->with('success', 'Offer Countered');
    }



    public function customerIndex()
    {
        $offers = Offer::mine()
            ->with('listing')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('dashboard.my-offers.index', ['offers' => $offers]);
    }

    public function customerShow($id)
    {
        $offer = Offer::find($id);

        return view('dashboard.my-offers.details', [
            'offer' => $offer
        ]);
    }

    public function customerAccept($id)
    {
        $offer = Offer::mine()->where('id', $id)->first();

        $offer->customerAccept();

        return redirect()
            ->route('payForAcceptedOffer');
    }

    public function customerReject($id)
    {
        $offer = Offer::mine()->where('id', $id)->first();

        $offer->customerReject();

        return redirect()
            ->back()
            ->with('success', 'Offer Countered');
    }
}
