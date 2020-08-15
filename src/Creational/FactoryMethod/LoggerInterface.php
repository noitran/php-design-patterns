<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

/**
 * "Product" interface
 *
 * The Product declares the interface, which is common to all objects
 * that can be produced by the creator and its subclasses.
 * Can be also abstract class instead of interface.
 */
interface LoggerInterface
{
    public function log($level, string $message, array $context = []);
}
