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
}