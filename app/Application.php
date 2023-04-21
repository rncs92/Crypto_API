<?php

namespace Crypto;

class Application
{
    private CryptoApi $cryptoApi;

    public function __construct(CryptoApi $cryptoApi)
    {
        $this->cryptoApi = $cryptoApi;
    }

    public function run(): void
    {
        while (true) {
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
            echo "                 CoinMarketCap Reporter" . PHP_EOL;
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;
            echo "Select 1: Get info about selected amount of coins" . PHP_EOL;
            echo "Select 2: Get info about market movements" . PHP_EOL;
            echo "Select 3: Get all info about specific coin(by symbol)" . PHP_EOL;
            echo "Select 0: Exit" . PHP_EOL;
            echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL;

            $command = (int)readline();
            if ($command == 0) {
                echo 'Bye, have a nice day!' . PHP_EOL;
                die;
            }
            switch ($command) {
                case 1:
                    $this->cryptoApi->coinsInfo();
                    break;
                case 2:
                    $this->cryptoApi->marketMovements();
                    break;
                case 3:
                    $this->cryptoApi->coinInfo();
                    break;
                default:
                    echo "Sorry, I don't understand you.." . PHP_EOL;
            }
        }
    }
}