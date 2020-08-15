<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

/**
 * Postgres specific code goes here.
 * Postgres SQL dialect differs from MySQL. So methods can be overridden or implemented here. Checkout how laravel
 * implements similar logic in their active record query builder.
 *
 * https://github.com/laravel/framework/blob/7.x/src/Illuminate/Database/Query/Grammars/PostgresGrammar.php
 */
class PostgresBuilder extends SqlBuilder
{
    /**
     * Postgres has different limit/offset syntax than MySQL.
     */
    public function compileOffset(Query $query, int $offset): string
    {
        return sprintf('start %u', $offset);
    }
}
