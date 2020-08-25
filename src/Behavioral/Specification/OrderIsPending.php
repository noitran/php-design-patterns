<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification;

class OrderIsPending implements Specification
{
    public function isSatisfiedBy(Order $order): bool
    {
        return 'pending' === $order->status();
    }
}
