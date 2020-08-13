<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

class User
{
    protected Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }
}
