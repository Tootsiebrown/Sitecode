<?php

namespace App\Mail;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferRejected extends Mailable
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
    ){
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
            ->subject('Catch\'n Dealz: Sorry, we can\'t accept your offer')
            ->view('mail.offer-rejected', [
                'offer' => $this->offer,
                'listing' => $this->offer->listing,
                'quantity' => $this->offer->quantity,
                'price' => $this->offer->price,
            ]);
    }
}
