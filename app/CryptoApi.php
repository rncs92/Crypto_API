<?php

namespace Crypto;
use Crypto\Models\Coin;
use GuzzleHttp\Client;

class CryptoApi
{
    private Client $client;
    private array $coins;

    public function __construct()
    {
    $this->client = new Client;
    }

    public function fetchLimit(string $limit = '1'): array
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
        $cryptoData = json_decode($response->getBody()->getContents());
        return $cryptoData->data;
    }

    public function fetchAll(): array
    {
        $apiKey = '4b3e9cde-7a27-4ccd-9e2d-65e1ade14d68';
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
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
        $limit = readline('Enter the number of cryptos you want to see: ');
        $coins = $this->fetchLimit($limit);
        foreach($coins as $coin) {
            $this->coins[] = new Coin(
                $coin->name,
                $coin->symbol,
                $coin->total_supply,
                $coin->max_supply,
                $coin->date_added,
                $coin->quote->EUR->price,
                $coin->quote->EUR->volume_24h,
                $coin->quote->EUR->percent_change_1h,
                $coin->quote->EUR->percent_change_24h,
                $coin->quote->EUR->percent_change_7d,
                $coin->quote->EUR->market_cap,
            );
        }
        return $this->coins;
    }

    public function info(): void
    {
        $coins = $this->createModelArray();
        foreach($coins as $coin) {
            /** @var Coin $coin */
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
            echo '[Name]: ' . $coin->getName() . PHP_EOL;
            echo '[ID]: ' . $coin->getSymbol() . PHP_EOL;
            echo '[Total supply]: ' . number_format($coin->getSupply()) . ' coins' . PHP_EOL;
            if($coin->getMaxSupply() == null) {
                echo '[Max cap]: Coin doesnt have a maximum cap!' . PHP_EOL;
            } else {
                echo '[Max cap]: ' . number_format($coin->getMaxSupply()) . ' coins' . PHP_EOL;
            }
            echo '[Release date]: ' . $coin->getAdded() . PHP_EOL;
            echo '[Price/coin]: €' . $coin->getPrice() . PHP_EOL;
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
        }
    }

    public function marketMovements(): void
    {
        $coins = $this->createModelArray();
        foreach($coins as $coin) {
            /** @var Coin $coin */
            echo '[Name]: ' . $coin->getName() . PHP_EOL;
            echo '[ID]: ' . $coin->getSymbol() . PHP_EOL;
            echo '[Price/coin]: €' . $coin->getPrice() . PHP_EOL;
            echo '[Total market cap]: €' . number_format($coin->getMarketCap()) . PHP_EOL;
            echo '[24hour trading volume]: €' . number_format($coin->getVolume()) . PHP_EOL;
            echo '[Value change in 1h]: ' . $coin->getChange1h() . '%' . PHP_EOL;
            echo '[Value change in 24h]: ' . $coin->getChange24h() . '%' . PHP_EOL;
            echo '[Value change in 7 days]: ' . $coin->getChange7d() . '%' . PHP_EOL;
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
        }
    }

    public function createModel(): array
    {
        $coins = $this->fetchAll();
        $symbol = readline('Please, enter the coin symbol: ');
        $matches = [];
        foreach($coins as $coin) {
            if($symbol == $coin->symbol) {
                $matches[] = new Coin(
                    $coin->name,
                    $coin->symbol,
                    $coin->total_supply,
                    $coin->max_supply,
                    $coin->date_added,
                    $coin->quote->EUR->price,
                    $coin->quote->EUR->volume_24h,
                    $coin->quote->EUR->percent_change_1h,
                    $coin->quote->EUR->percent_change_24h,
                    $coin->quote->EUR->percent_change_7d,
                    $coin->quote->EUR->market_cap,
                );
            }
        };
        return $matches;
    }

    public function coinInfo(): void
    {
        $coins = $this->createModel();
        foreach($coins as $coin) {
            echo '[Name]: ' . $coin->getName() . PHP_EOL;
            echo '[ID]: ' . $coin->getSymbol() . PHP_EOL;
            echo '[Total supply]: ' . number_format($coin->getSupply()) . ' coins' . PHP_EOL;
            if($coin->getMaxSupply() == null) {
                echo '[Max cap]: Coin doesnt have a maximum cap!' . PHP_EOL;
            } else {
                echo '[Max cap]: ' . number_format($coin->getMaxSupply()) . ' coins' . PHP_EOL;
            }
            echo '[Release date]: ' . $coin->getAdded() . PHP_EOL;
            echo '[Price/coin]: €' . $coin->getPrice() . PHP_EOL;
            echo '[Total market cap]: €' . number_format($coin->getMarketCap()) . PHP_EOL;
            echo '[24hour trading volume]: €' . number_format($coin->getVolume()) . PHP_EOL;
            echo '[Value change in 1h]: ' . $coin->getChange1h() . '%' . PHP_EOL;
            echo '[Value change in 24h]: ' . $coin->getChange24h() . '%' . PHP_EOL;
            echo '[Value change in 7 days]: ' . $coin->getChange7d() . '%' . PHP_EOL;
        }
    }
}