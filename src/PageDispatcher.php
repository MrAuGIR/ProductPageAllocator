<?php

namespace MrAuGir\ElementGridAllocation;

use MrAuGir\ElementGridAllocation\Grid\Grid;
use MrAuGir\ElementGridAllocation\Page\PageCollection;
use MrAuGir\ElementGridAllocation\Template\GridElementInterface;

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
