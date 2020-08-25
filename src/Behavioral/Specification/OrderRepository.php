<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification;

class OrderRepository
{
    protected array $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public function bySpecification(Specification $specification): array
    {
        return array_filter($this->orders, static function ($order) use ($specification) {
            return $specification->isSatisfiedBy($order);
        });
    }
}
