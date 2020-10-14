<?php

namespace App\Mail;

use App\Models\Listing;
use App\Models\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CounterOfferExpired extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Offer
     */
    private Offer $offer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Offer $offer
    ) {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->offer->user->email)
            ->subject('Catch\'n Dealz: Your counter offer expired.')
            ->view('mail.counter-offer-expired', [
                'offer' => $this->offer,
                'listing' => $this->offer->listing,
                'quantity' => $this->offer->counter_quantity,
                'price' => $this->offer->counterprice,
            ]);
    }
}
