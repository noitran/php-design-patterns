<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Sources;

use Noitran\Patterns\Structural\Decorator\Contracts\DataSource;

/**
 * ConcreteComponent: There can be multiple concrete variations of the Component.
 * This acts as the child's class and will be the actual object being wrapped by the Decorator.
 */
class StringDataSource implements DataSource
{
    public ?string $resource;

    public function __construct(string $resource)
    {
        $this->resource = $resource;
    }

    public function write(): string
    {
        return $this->resource;
    }

    public function read(): string
    {
        return $this->resource;
    }
}
