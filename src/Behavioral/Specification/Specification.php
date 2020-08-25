<?php

declare(strict_types=1);

namespace Noitran\Patterns\Behavioral\Specification;

interface Specification
{
    public function isSatisfiedBy(Order $order): bool;
}
