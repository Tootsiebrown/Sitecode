<?php

namespace App\Ebay\Requests;

class GetEbayDetails extends AbstractRequest
{
    protected array $data = [
        'GetEbayDetailsRequest' => [],
    ];

    public function setVersion(int $version): void
    {
        $this->data['GetEbayDetailsRequest']['Version'] = $version;
    }

    public function setDetails(array $details) {
        $this->data['GetEbayDetailsRequest']['DetailName'] = $details;
    }
}
