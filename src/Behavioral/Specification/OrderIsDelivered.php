<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification;

class OrderIsDelivered implements Specification
{
    public function isSatisfiedBy(Order $order): bool
    {
        return 'delivered' === $order->status();
    }
}
