<?php

namespace Crypto;
use GuzzleHttp\Client;

class CryptoApi
{
    private Client $client;

    public function __construct()
    {
    $this->client = new Client;
    }

    public function getCrypto(string $limit = '10'): object
    {
        $apiKey = '4b3e9cde-7a27-4ccd-9e2d-65e1ade14d68';
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => $limit,
            'convert' => 'EUR'
        ];

        $response = $this->client->get($url, [
            'headers' => [
                'X-CMC_PRO_API_KEY' => $apiKey,
                'Accept' => 'application/json',
            ],
            'query' => $parameters
        ]);

        return json_decode($response->getBody()->getContents());
    }
}