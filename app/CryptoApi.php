<?php

namespace Crypto;
use Crypto\Models\Crypto;
use GuzzleHttp\Client;

class CryptoApi
{
    private Client $client;
    private array $cryptos;

    public function __construct()
    {
    $this->client = new Client;
    }

    public function fetchAll(string $limit = '10')
    {
        $limit = readline('Enter the number of cryptos you want to see: ');
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
        $cryptoData = json_decode($response->getBody()->getContents());
        return $cryptoData->data;
    }

    private function createModelArray(): array
    {
        $cryptos = $this->fetchAll();
        foreach($cryptos as $crypto) {
            $this->cryptos[] = new Crypto(
                $crypto->name,
                $crypto->symbol,
                $crypto->total_supply,
                $crypto->max_supply,
                $crypto->date_added,
                $crypto->quote->EUR->price
            );
        }
        return $this->cryptos;
    }

    public function display(): void
    {
        $cryptos = $this->createModelArray();
        foreach($cryptos as $crypto) {
            /** @var Crypto $crypto */
            echo 'Name: ' . $crypto->getName() . PHP_EOL;
            echo 'ID: ' . $crypto->getSymbol() . PHP_EOL;
            echo 'Total supply: ' . number_format($crypto->getSupply()) . ' coins' . PHP_EOL;
            if($crypto->getMaxSupply() == null) {
                echo 'Max cap: Coin doesnt have a maximum cap!' . PHP_EOL;
            } else {
                echo 'Max cap: ' . number_format($crypto->getMaxSupply()) . PHP_EOL;
            }
            echo 'Release date: ' . $crypto->getAdded() . PHP_EOL;
            echo 'Price/coin: €' . $crypto->getPrice() . PHP_EOL;
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
        }
    }
}