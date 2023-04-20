<?php

namespace Crypto\Models;
use Carbon\Carbon;

class Coin
{
    private string $name;
    private string $symbol;
    private int $supply;
    private ?int $maxSupply;
    private string $added;
    private float $price;
    private int $volume;
    private float $change1h;
    private float $change24h;
    private float $change7d;
    private int $marketCap;

    public function __construct(string $name, string $symbol,
                                int $supply, ?int $maxSupply,
                                string $added, float $price,
                                int $volume, float $change1h,
                                float $change24h, float $change7d,
                                int $marketCap
    )
{
    $this->name = $name;
    $this->symbol = $symbol;
    $this->supply = $supply;
    $this->maxSupply = $maxSupply;
    $this->added = $added;
    $this->price = $price;
    $this->volume = $volume;
    $this->change1h = $change1h;
    $this->change24h = $change24h;
    $this->change7d = $change7d;
    $this->marketCap = $marketCap;
}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPrice(): float
    {
        return round($this->price, 2);
    }

    public function getAdded(): string
    {
        return Carbon::parse($this->added)->isoFormat('LL');
    }

    public function getMaxSupply(): ?int
    {
        return $this->maxSupply;
    }

    public function getSupply(): int
    {
        return $this->supply;
    }

    public function getChange1h(): float
    {
        return round($this->change1h, 3);
    }

    public function getChange7d(): float
    {
        return round($this->change7d, 3);
    }

    public function getChange24h(): float
    {
        return round($this->change24h, 3);
    }

    public function getMarketCap(): int
    {
        return $this->marketCap;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }
}