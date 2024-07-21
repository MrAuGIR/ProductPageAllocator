<?php

namespace MrAuGir\Paginator;

use MrAuGir\Paginator\Cursor\Cursor;
use MrAuGir\Paginator\Cursor\Positionable;
use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

class GridNavigator
{
    public ?Positionable $cursor;

    public function __construct()
    {
        $this->cursor = new Cursor(0,0);
    }

    public function initCursor(Positionable $cursor): self
    {
        $this->cursor = $cursor;
        return $this;
    }

    public function moveOnLineCursor(Positionable $cursor, TemplatePaginatorInterface $template): void
    {
        $cursor->upX($template->getLenthInColumn());
    }

    public function moveOnNewLineCursor(Positionable $cursor, TemplatePaginatorInterface $template): void
    {
        $cursor->resetX();
        $cursor->upY($template->getLenthInColumn());
    }
}