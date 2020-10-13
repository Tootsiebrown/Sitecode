<?php

namespace App\Mail;

use App\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyWatcherBidReceived extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Bid
     */
    public Bid $bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Catch\'n Dealz: New Bid on an Auction You\'re Watcing')
            ->view('mail.notify-watcher-bid-received');
    }
}
