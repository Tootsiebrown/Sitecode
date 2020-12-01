<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyWinnerPaymentNeeded extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Listing
     */
    public Listing $listing;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Catch\'n Dealz: An auction you won is ready to be paid for')
            ->view('mail.notify-winner-payment-needed')
            ->with(['listing' => $this->listing]);
    }
}
