<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Prototype;

class Transfer extends ItemPrototype
{
    protected string $type = 'transfer';

    public function __clone()
    {
        //
    }
}
