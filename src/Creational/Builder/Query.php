<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

class Query
{
    public array $columns;

    public string $from;

    public array $wheres;

    public int $limit;

    public int $offset;

    protected array $selectComponents = [
        'columns',
        'from',
        'wheres',
        'limit',
        'offset',
    ];

    /**
     * @return array|string[]
     */
    public function getSelectComponents(): array
    {
        return $this->selectComponents;
    }
}
