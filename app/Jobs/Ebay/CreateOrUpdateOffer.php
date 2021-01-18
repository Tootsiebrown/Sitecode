<?php

namespace App\Jobs\Ebay;

use App\Ebay\Sdk;
use App\Models\Listing;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class CreateOrUpdateOffer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** @var Listing */
    private Listing $listing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Sdk $ebay)
    {
        try {
            $offerId = $ebay->createOffer($this->listing);
        } catch (BadResponseException $e) {
            $e->getResponse()->getBody()->seek(0);
            $response = json_decode($e->getResponse()->getBody()->getContents());
            //{"errors":[{"errorId":25002,"domain":"API_INVENTORY","subdomain":"Selling","category":"REQUEST","message":"A user error has occurred. Offer entity already exists.","parameters":[{"name":"offerId","value":"104682640013"}]}]}
            $firstError = current($response->errors);
            if ($firstError->message == 'A user error has occurred. Offer entity already exists.') {
                $offerId = null;
                foreach ($firstError->parameters as $parameter) {
                    if ($parameter->name == 'offerId') {
                        $offerId = $parameter->value;
                        break;
                    }
                }
                if ($offerId) {
                    $this->listing->ebay_offer_id = $offerId;
                    $this->listing->save();
                }

                $ebay->updateOffer($this->listing);
            } else {
                throw $e;
            }
        } catch (\Exception $e) {
            $this->listing->to_ebay_error_at = Carbon::now()->toDateTimeString();
            $this->listing->save();
            throw $e;
        }

        $this->listing->ebay_offer_id = $offerId;
        $this->listing->sent_to_ebay_at = Carbon::now()->toDateTimeString();
        $this->listing->save();

        PublishOffer::dispatch($this->listing);
    }

    public function maxTries()
    {
        return 3;
    }
}
