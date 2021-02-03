<?php

namespace App\Console\Commands;

use App\Wax\Shop\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Wax\Shop\Mail\OrderPlaced;

class ResendOrderConfirmationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:order-confirmation {orderId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order = Order::find($this->argument('orderId'));

        if (empty($order->email)) {
            $this->output->warning('order not found');
        }

        // Customer Email
        Mail::to($order->email)
            ->queue(new OrderPlaced($order));
    }
}
