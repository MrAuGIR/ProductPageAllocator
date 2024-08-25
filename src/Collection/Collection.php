<?php

namespace MrAuGir\Paginator\Collection;

use Traversable;

class Collection implements CollectionInterface
{

    private array $elements;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add($element): void
    {
        $this->elements[] = $element;
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function contains($element): bool
    {
        return in_array($element,$this->elements,true);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function remove($element): bool
    {
        $key = array_search($element, $this->elements, true);
        if ($key !== false) {
            unset($this->elements[$key]);
            $this->elements = array_values($this->elements); // Reindex array
            return true;
        }
        return false;
    }

    public function removeElement($key)
    {
        if (isset($this->elements[$key])) {
            $removed = $this->elements[$key];
            unset($this->elements[$key]);
            return $removed;
        }
        return null;
    }

    public function containsKey($key): bool
    {
        return array_key_exists($key, $this->elements);
    }

    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    public function getKeys(): array
    {
        return array_keys($this->elements);
    }

    public function getValues(): array
    {
        return array_values($this->elements);
    }

    public function set(int|string $key, $value): void
    {
        $this->elements[$key] = $value;
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->elements);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->containsKey($offset);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->add($value);
        } else {
            $this->set($offset, $value);
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->removeElement($offset);
    }

    public static function create(array $items): CollectionInterface
    {
        return new self($items);
    }
}
