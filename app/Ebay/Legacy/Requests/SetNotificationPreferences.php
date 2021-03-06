<?php

namespace App\Ebay\Legacy\Requests;

class SetNotificationPreferences extends AbstractRequest
{
    protected array $data = [
        'SetNotificationPreferencesRequest' => [
            'ApplicationDeliveryPreferences' => [
                'ApplicationEnable' => 'Enable',
                'ApplicationURL' => null,
            ],
        ],
    ];

    public function __construct()
    {
        $this->data['SetNotificationPreferencesRequest']
            ['ApplicationDeliveryPreferences']
            ['ApplicationURL'] = route('webhooks.ebayNotification');
    }

    public function setVersion(int $version): void
    {
        $this->data['SetNotificationPreferencesRequest']['Version'] = $version;
    }

    public function setCheckoutSubscription(bool $subscribed)
    {
        $this->data['SetNotificationPreferencesRequest']
            ['UserDeliveryPreferenceArray']
            ['NotificationEnable'][] = [
                'EventEnable' => $subscribed
                    ? 'Enable'
                    : 'Disable',
                'EventType' => 'AuctionCheckoutComplete',
            ];
    }

    public function setTransactionSubscription(bool $subscribed)
    {
        $this->data['SetNotificationPreferencesRequest']
            ['UserDeliveryPreferenceArray']
            ['NotificationEnable'][] = [
                'EventEnable' => $subscribed
                    ? 'Enable'
                    : 'Disable',
                'EventType' => 'FixedPriceTransaction',
            ];
    }
}
