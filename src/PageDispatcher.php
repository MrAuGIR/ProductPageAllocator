<?php

namespace MrAuGir\Paginator;

use MrAuGir\Paginator\Grid\Grid;
use MrAuGir\Paginator\Page\PageCollection;
use MrAuGir\Paginator\Template\GridElementInterface;

class PageDispatcher
{
    private Grid $grid;

    private PageCollection $pageCollection;

    public function __construct()
    {
        $this->grid = new Grid(10, 8);
        $this->pageCollection = new PageCollection();
    }

    /**
     * @param GridElementInterface[] $blocks
     * @return void
     */
    public function dispatch(array $blocks): void
    {
        foreach ($blocks as $block) {
            $this->grid->findPositionForBlock($block, $this->pageCollection);
        }
    }

    public function reset(): void
    {
        $this->pageCollection = new PageCollection();
    }

    public function getPageCollection(): PageCollection
    {
        return $this->pageCollection;
    }

    public function setPageCollection(PageCollection $pageCollection): void
    {
        $this->pageCollection = $pageCollection;
    }

}
