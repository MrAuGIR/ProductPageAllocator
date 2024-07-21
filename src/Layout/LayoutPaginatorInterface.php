<?php

namespace MrAuGir\Paginator\Layout;

use MrAuGir\Paginator\Cursor\Positionable;

interface LayoutPaginatorInterface
{
    public function getSlots(): int;

    public function getFreeSlot():int;

    public function getColumns(): int;

    public function getRows(): int;

    public function getCurrentCursor(): Positionable;

    public function initCursor(Positionable $positionable):self;
}