<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

use DateTime;

/**
 * https://en.wikipedia.org/wiki/Prototype_pattern
 */
abstract class ItemPrototype
{
    protected string $type;

    protected string $currency;

    protected float $amount;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    abstract public function __clone();

    public function currency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function updatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
