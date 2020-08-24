<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Decorators;

use Noitran\Patterns\Structural\Decorator\Contracts\DataSource;

/**
 * Decorator: This abstract class acts as a base class for all the concrete decorators.
 * This class will most likely share the same public interface as the Component and uses a constructor
 * that takes a Component to wrap. The Decorator public method that is called will typically proxy
 * the same public method for the Component.
 */
abstract class DataDecorator implements DataSource
{
    protected DataSource $dataSource;

    public function __construct(DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function write()
    {
        return $this->dataSource->write();
    }

    public function read()
    {
        return $this->dataSource->read();
    }
}
