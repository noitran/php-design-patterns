<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

/**
 * Director is considered as optional class as client can operate and control builder instance directly.
 * It can be useful in building complex objects in particular sequence, specific order or configuration.
 */
class Director
{
    protected Builder $queryBuilder;

    public function __construct(Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function build(): Builder
    {
        return $this->queryBuilder->select(['email', 'name', 'surname'])
            ->from('users')
            ->where('name', 'John')
            ->where('surname', 'Doe')
            ->limit(5)
            ->rawSql();
    }
}
