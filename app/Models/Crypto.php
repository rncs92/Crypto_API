<?php

namespace Crypto\Models;
use Carbon\Carbon;

class Crypto
{
    private string $name;
    private string $symbol;
    private int $supply;
    private ?int $maxSupply;
    private string $added;
    private float $price;

    public function __construct(string $name, string $symbol, int $supply, ?int $maxSupply, string $added, float $price)
{
    $this->name = $name;
    $this->symbol = $symbol;
    $this->supply = $supply;
    $this->maxSupply = $maxSupply;
    $this->added = $added;
    $this->price = $price;
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
}