<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

/**
 * Interface defines a set of methods for building sql queries. Public methods are returning
 * SqlBuilder object in its current state for easy chaining
 */
interface Builder
{
    public function select($columns = ['*']);

    public function from(string $table);

    public function where($column, $value = null, $operator = null);

    public function limit(int $limit);

    public function offset(int $offset);

    public function rawSql(): string;
}
