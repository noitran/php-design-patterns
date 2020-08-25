<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification;

class Order
{
    protected string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function status(): string
    {
        return $this->status;
    }
}
