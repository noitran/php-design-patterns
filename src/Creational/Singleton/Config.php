<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton;

use ArrayAccess;

class Config extends Singleton implements ArrayAccess
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        parent::__construct();

        $this->items = $items;
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->items);
    }

    public function get($key, $default = null)
    {
        if (! $this->has($key)) {
            return $default;
        }

        return $this->items[$key];
    }

    public function set($key, $value = null): void
    {
        $this->items[$key] = $value;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    public function offsetGet($key)
    {
        return $this->get($key);
    }

    public function offsetSet($key, $value): void
    {
        $this->set($key, $value);
    }

    public function offsetUnset($key): void
    {
        $this->set($key);
    }
}
