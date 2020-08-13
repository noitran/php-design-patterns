<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

/**
 * Class is created just to show circular reference example in prototypes
 */
class User
{
    protected Income $income;

    public function __construct(Income $income)
    {
        $this->income = $income;
    }

    public function setIncome(Income $income): void
    {
        $this->income = $income;
    }

    public function getIncome(): Income
    {
        return $this->income;
    }
}
