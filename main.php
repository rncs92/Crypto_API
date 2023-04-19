<?php

require 'vendor/autoload.php';
use Crypto\CryptoApi;

$client = new CryptoApi();
$limit = readline('Enter the number of cryptos you want to see: ');
$crypto = $client->getCrypto($limit);
var_dump($crypto);