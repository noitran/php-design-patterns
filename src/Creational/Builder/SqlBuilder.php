<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Builder;

/**
 * Abstract SQL builder which defines functions that are same for all SQL servers.
 */
abstract class SqlBuilder implements Builder
{
    protected ?Query $query;

    public function __construct(Query $query = null)
    {
        $this->query = $query ?: new Query;
    }

    public function select($columns = ['*']): SqlBuilder
    {
        $this->query->columns = $columns;

        return $this;
    }

    public function from(string $table): SqlBuilder
    {
        $this->query->from = $table;

        return $this;
    }

    public function where($column, $value = null, $operator = null): SqlBuilder
    {
        $this->query->wheres[] = [
            'column' => $column,
            'value' => $value,
            'operator' => $operator ?: '=',
        ];

        return $this;
    }

    public function limit(int $limit): SqlBuilder
    {
        $this->query->limit = $limit;

        return $this;
    }

    public function offset(int $offset): SqlBuilder
    {
        $this->query->offset = $offset;

        return $this;
    }

    public function rawSql(): string
    {
        return $this->compileSelect($this->query);
    }

    protected function concatenate($segments): string
    {
        return implode(' ', array_filter($segments, static function ($value) {
            return (string) $value !== '';
        }));
    }

    protected function compileSelect(Query $query): string
    {
        $original = $query->columns;

        if (is_null($query->columns)) {
            $query->columns = ['*'];
        }

        $sql = trim(
            $this->concatenate($this->compileComponents($query))
        );
        $query->columns = $original;

        return $sql;
    }

    protected function compileComponents(Query $query): array
    {
        $sql = [];

        foreach ($this->query->getSelectComponents() as $component) {
            if (! is_null($query->$component)) {
                $method = 'compile' . ucfirst($component);

                $sql[$component] = $this->$method($query, $query->$component);
            }
        }

        return $sql;
    }

    protected function compileColumns(Query $query, array $columns): string
    {
        return sprintf('select %s', implode(', ', $columns));
    }

    protected function compileFrom(Query $query, $table): string
    {
        return sprintf('from %s', $table);
    }

    protected function compileWheres(Query $query): string
    {
        if (is_null($query->wheres)) {
            return '';
        }

        $sql = [];

        foreach ($query->wheres as $where) {
            $sql[] = $where['column'] . ' ' . $where['operator'] . ' ' . $where['value'];
        }

        return 'where ' . implode(' and ', $sql);
    }

    protected function compileLimit(Query $query, int $limit): string
    {
        return sprintf('limit %u', $limit);
    }

    protected function compileOffset(Query $query, int $offset): string
    {
        return sprintf(', %u', $offset);
    }
}
