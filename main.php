<?php

require 'vendor/autoload.php';
use Crypto\CryptoApi;
use Crypto\Application;

$client = new CryptoApi();
$app = new Application($client);
$app->run();