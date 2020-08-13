<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

/**
 * Class responds for Mysql specific dialect of SQL and can override base SqlBuilder methods or implement new ones
 * Checkout how laravel implements similar logic in their active record query builder:
 *
 * https://github.com/laravel/framework/blob/7.x/src/Illuminate/Database/Query/Grammars/MySqlGrammar.php
 */
class MySqlBuilder extends SqlBuilder
{
    // Mysql specific code goes here
}
