<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

abstract class SqlBuilder implements Builder
{
    protected array $parameters;

    protected ?string $sql;

    public function select($columns = ['*']): void
    {
        // TODO: Implement select() method.
    }

    public function from(string $table): void
    {
        // TODO: Implement from() method.
    }

    public function where($column, $value = null, $operator = null): void
    {
        // TODO: Implement where() method.
    }

    public function limit($value): void
    {
        // TODO: Implement limit() method.
    }

    public function rawSql(): string
    {
        return '...';
    }

    protected function reset(): void
    {
        //
    }
}
