<?php

namespace App\Mail;

use App\Models\Listing;
use App\Models\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferSubmitted extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Listing
     */
    public Listing $listing;
    private int $quantity;
    private $price;
    /**
     * @var User
     */
    private User $user;
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
        Offer $offer,
        Listing $listing,
        int $quantity,
        $price,
        User $user
    ){
        $this->offer = $offer;
        $this->listing = $listing;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.offer-submitted', [
            'offer' => $this->offer,
            'listing' => $this->listing,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user' => $this->user,
        ]);
    }
}
