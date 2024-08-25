<?php

namespace MrAuGir\Paginator\Page;

class PageCollection
{
    /**
     * @var Page[] $pages
     */
    public array $pages;


    public function __construct(public int $start = 1)
    {
        $this->pages = [];
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
}
