<?php

namespace App\Mail;

use App\Models\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyWinner extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Listing
     */
    public Listing $listing;

    /**
     * @var User
     */
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Listing $listing, User $user)
    {
        $this->listing = $listing;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Catch\'n Dealz: You won!')
            ->view('mail.notify-winner');
    }
}
