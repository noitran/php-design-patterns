<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype\RealWorld;

use DateTime;

class Invoice
{
    protected string $currency;

    protected array $items;

    protected array $taxes;

    protected array $payments;

    /**
     * Class that has circular reference (References back to Invoice class)
     * https://medium.com/@johann.pardanaud/about-circular-references-in-php-10f71f811e9
     * https://johann.pardanaud.com/blog/about-circular-references-in-php
     */
    protected User $user;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    /**
     * By default everything is cloned, but as objects are passed by reference, they aren't copied, and after cloning,
     * object still points to old instance, so you have to manually deep clone them.
     * https://www.php.net/manual/en/language.oop5.references.php
     *
     */
    public function __clone()
    {
        $this->createdAt = clone $this->createdAt;
        $this->updatedAt = clone $this->updatedAt;

        // Cloning an object that has a nested object with backreference requires special treatment.
        // After the cloning is completed, the nested object should point to the cloned object, instead of the
        // original object.
        $this->user = clone $this->user;
        // One of the Prototype drawbacks is that __constructor method isn't executed during cloning, so, it has
        // to be manually called.
        $this->user->setInvoice($this);
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
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
