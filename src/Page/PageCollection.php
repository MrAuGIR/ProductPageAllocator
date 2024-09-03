<?php

namespace MrAuGir\ElementGridAllocation\Page;

use ArrayObject;
use InvalidArgumentException;

class PageCollection extends ArrayObject
{
    /**
     * @param int $start
     */
    public function __construct(private int $start = 1)
    {
        // Initialise l'ArrayObject avec un tableau vide
        parent::__construct([]);
    }

    /**
     * @param Page $page
     * @return $this
     */
    public function addPage(Page $page): self
    {
        // Utilise l'index de la page comme clé
        $this[$page->index] = $page;
        return $this;
    }

    /**
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
     * @param int $index
     * @return void
     */
    public function removePage(int $index): void
    {
        $this->offsetUnset($index);
    }

    /**
     * @param int $index
     * @return bool
     */
    public function hasPage(int $index): bool
    {
        return $this->offsetExists($index);
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * @param $index
     * @param $newval
     * @return void
     */
    public function offsetSet($index, $newval): void
    {
        if (!$newval instanceof Page) {
            throw new InvalidArgumentException('Value must be an instance of Page.');
        }
        parent::offsetSet($index, $newval);
    }
}
