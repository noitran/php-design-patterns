<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

class Expense extends ItemPrototype
{
    protected string $type = 'expense';

    public function __clone()
    {
        //
    }
}
