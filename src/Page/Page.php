<?php

namespace MrAuGir\ElementGridAllocation\Page;

use MrAuGir\ElementGridAllocation\Grid\Grid;
use MrAuGir\ElementGridAllocation\Template\GridElementInterface;

class Page
{
    public ?Grid $grid;

    public int $index;

    public function __construct()
    {
        $this->blocks = [];
    }

    /**
     * @var GridElementInterface[]
     */
    public array $blocks;

    public function getGrid(): ?Grid
    {
        return $this->grid;
    }

    public function setGrid(Grid $grid): self
    {
        $this->grid = $grid;

        return $this;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function setBlocks(array $blocks): self
    {
        $this->blocks = $blocks;

        return $this;
    }


    public function  addBlock(GridElementInterface $block): self
    {
        $this->blocks[] = $block;

        return $this;
    }
}
