<?php

namespace App\ValueObjects;

class Price
{
    protected int $original;
    protected float $value;
    private string $currency;

    public function __construct(int $value, string $currency = '€')
    {
        $this->currency = $currency;
        $this->original = $value;
        $this->value = (float) round($value / 100, 2);
    }

    public function valueFormatted(): string
    {
        return number_format($this->value(), 2) . $this->currency;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function original(): int
    {
        return $this->original;
    }
}
