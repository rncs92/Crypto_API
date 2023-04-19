<?php

namespace Crypto\Models;
use Carbon\Carbon;

class Crypto
{
    private string $name;
    private string $symbol;
    private int $supply;
    private int $maxSupply;
    private Carbon $added;
    private float $price;

    public function __construct(string $name, string $symbol, int $supply, int $maxSupply, Carbon $added, float $price)
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
        return $this->price;
    }

    public function getAdded(): Carbon
    {
        return Carbon::parse($this->added);
    }

    public function getMaxSupply(): int
    {
        return $this->maxSupply;
    }

    public function getSupply(): int
    {
        return $this->supply;
    }
}