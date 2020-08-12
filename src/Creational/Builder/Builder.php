<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

interface Builder
{
    public function select($columns = ['*']);

    public function from(string $table);

    public function where($column, $value = null, $operator = null);

    public function limit($value);

    public function rawSql(): string;
}
