<?php

namespace App\Ebay\Legacy\Requests;

class GetNotificationPreferences extends AbstractRequest
{
    protected array $data = [
        'GetNotificationPreferencesRequest' => [
            'PreferenceLevel' => 'Application',
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['GetNotificationPreferencesRequest']['Version'] = $version;
    }
}
