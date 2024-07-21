<?php

namespace MrAuGir\Paginator\Layout;

use MrAuGir\Paginator\Cursor\Cursor;
use MrAuGir\Paginator\Cursor\Positionable;

class DefaultLayout implements LayoutPaginatorInterface
{
    protected int $slots;

    protected int $freeSlots = 0;

    protected Positionable $cursor;

    public function __construct(
        protected int $columns,
        protected int $rows
    )
    {
        $this->cursor = new Cursor(0,0);
        $this->slots = $this->columns * $this->rows;
        $this->freeSlots = $this->slots;
    }

    public function getSlots(): int
    {
        return $this->slots;
    }

    public function getFreeSlot(): int
    {
        return $this->freeSlots;
    }

    public function getColumns(): int
    {
        return $this->rows;
    }

    public function getRows(): int
    {
        return $this->columns;
    }

    public function getCurrentCursor(): Positionable
    {
        return $this->cursor;
    }

    public function initCursor(Positionable $positionable): LayoutPaginatorInterface
    {
        $this->cursor = $positionable;
        return $this;
    }
}