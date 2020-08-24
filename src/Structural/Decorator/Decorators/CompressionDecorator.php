<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Decorators;

class CompressionDecorator extends DataDecorator
{
    public function write(): string
    {
        return gzencode(parent::write());
    }

    public function read(): string
    {
        return gzdecode(parent::read());
    }
}
