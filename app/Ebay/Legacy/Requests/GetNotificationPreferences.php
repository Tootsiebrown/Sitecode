<?php

namespace App\Ebay\Legacy\Requests;

class GetNotificationPreferences extends AbstractRequest
{
    protected array $data = [
        'GetNotificationPreferencesRequest' => [
            'PreferenceLevel' => 'User',
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['GetNotificationPreferencesRequest']['Version'] = $version;
    }

    public function setPreferenceLevel(string $preferenceLevel)
    {
        $this->data['GetNotificationPreferencesRequest']
            ['PreferenceLevel'] = $preferenceLevel;
    }
}
