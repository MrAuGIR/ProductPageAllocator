<?php

namespace MrAuGir\Paginator\Page;

class PageCollection implements \Iterator, \Countable, \ArrayAccess
{
    /**
     * @var Page[] $pages
     */
    public array $pages;

    /**
     * Current position for iterator
     * @var int
     */
    private int $position = 0;

    public function __construct(public int $start = 1)
    {
        $this->pages = [];
        $this->position = 0;
    }

    public function addPage(Page $page): self
    {
        $this->pages[$page->index] = $page;
        return $this;
    }

    public function getOrCreatePage(int $index): Page
    {
        if (!isset($this->pages[$index])) {
            $this->pages[$index] = new Page();
            $this->pages[$index]->index = $index;
        }
        return $this->pages[$index];
    }

    // Implementation of Iterator methods
    public function current(): mixed
    {
        return $this->pages[array_keys($this->pages)[$this->position]] ?? null;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): ?int
    {
        return array_keys($this->pages)[$this->position] ?? null;
    }

    public function valid(): bool
    {
        return isset(array_keys($this->pages)[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    // Implementation of Countable method
    public function count(): int
    {
        return count($this->pages);
    }

    // Implementation of ArrayAccess methods
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->pages[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->pages[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Page) {
            throw new \InvalidArgumentException('Value must be an instance of Page.');
        }

        if ($offset === null) {
            $this->pages[] = $value;
        } else {
            $this->pages[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->pages[$offset]);
    }
}
