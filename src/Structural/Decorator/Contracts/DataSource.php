<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Contracts;

/**
 * Component - An abstract class or interface that acts as the parent class for ConcreteComponent.
 */
interface DataSource
{
    public function write();

    public function read();
}
