<?php

namespace App\Gateways;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DatafinitiGateway
{
    protected string $token;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
        $this->token = config('app.datafiniti.token');
    }

    public function getRequestBody($code)
    {
        return [
            'query' => 'gtins:' . $code,
            'format' => 'JSON',
            'num_records' => 5,
            'download' => false,
        ];
    }

    public function getKey($code)
    {
        return 'df.' . $this->getRequestBody($code)['query'];
    }

    public function barCodeSearch($code)
    {
        if (empty($code)) {
            return collect();
        }

        $requestBody = $this->getRequestBody($code);
        $key = $this->getKey($code);

        return Cache::store('database')
            ->remember($key, now()->addWeeks(2), function () use ($requestBody) {
                $response = $this->client->post(
                    'https://api.datafiniti.co/v4/products/search',
                    [
                        'headers' => [
                            'Authorization' => sprintf("Bearer %s", $this->token),
                            'Content-Type' => 'application/json',
                        ],
                        'json' => $requestBody,
                    ]
                );

                $json = (string)$response->getBody();
                $result = json_decode($json, 1);

                return collect($result['records'])
                     ->map(fn($record) => $this->processRecord($record));
            });
    }

    protected function processRecord($record)
    {
        if (! isset($record['descriptions'])) {
            $record['descriptions'] = [];
        } else {
            $record['descriptions'] = collect($record['descriptions'])
                ->pluck('value')
                ->sort(fn($a, $b) => Str::length($b) <=> Str::length($a))
                ->values()->all();
        }

        return $record;
    }
}
