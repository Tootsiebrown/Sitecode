<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyNoWinner extends Mailable
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
            ->subject('Catch\'n Dealz: Sorry, someone else won.')
            ->view('mail.notify-no-winner');
    }
}
