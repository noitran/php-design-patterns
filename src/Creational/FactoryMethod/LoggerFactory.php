<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

/**
 * "Creator" - interface (or abstract class) that is used for all concrete creators. Can contain shared
 * functionality used by all/most concrete creators. If factories don’t differ for each type of product,
 * then this can become a single concrete creator itself and is no longer abstract.
 *
 * "Creator" return type should be "Product" interface.
 */
interface LoggerFactory
{
    public function createLogger(): LoggerInterface;
}
