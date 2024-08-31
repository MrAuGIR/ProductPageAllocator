<?php

namespace MrAuGir\Paginator\Page;

use ArrayObject;
use InvalidArgumentException;

class PageCollection extends ArrayObject
{
    /**
     * PageCollection constructor.
     *
     * @param int $start
     */
    public function __construct(private int $start = 1)
    {
        // Initialise l'ArrayObject avec un tableau vide
        parent::__construct([]);
    }

    /**
     * Add a page to the collection.
     *
     * @param Page $page
     * @return self
     */
    public function addPage(Page $page): self
    {
        // Utilise l'index de la page comme clé
        $this[$page->index] = $page;
        return $this;
    }

    /**
     * Get or create a page at the specified index.
     *
     * @param int $index
     * @return Page
     */
    public function getOrCreatePage(int $index): Page
    {
        if (!$this->offsetExists($index)) {
            $this[$index] = new Page();
            $this[$index]->index = $index;
        }

        return $this[$index];
    }

    /**
     * Remove a page at the specified index.
     *
     * @param int $index
     */
    public function removePage(int $index): void
    {
        $this->offsetUnset($index);
    }

    /**
     * Check if a page exists at the specified index.
     *
     * @param int $index
     * @return bool
     */
    public function hasPage(int $index): bool
    {
        return $this->offsetExists($index);
    }

    /**
     * Get all pages in the collection.
     *
     * @return Page[]
     */
    public function getPages(): array
    {
        return $this->getArrayCopy();
    }
}
