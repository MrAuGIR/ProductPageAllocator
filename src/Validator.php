<?php

namespace MrAuGir\Paginator;

use MrAuGir\Paginator\Layout\LayoutPaginatorInterface;
use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

class Validator
{
    public function validateSlot(TemplatePaginatorInterface $template, LayoutPaginatorInterface $layout): bool
    {
        if ($template->getSlots() > $layout->getSlots()) {
            return false;
        }
        return true;
    }

    public function validPosition(TemplatePaginatorInterface $template, LayoutPaginatorInterface $layout): bool
    {
        $xb = $layout->getCurrentCursor()->getX() + $template->getLenthInColumn();
        $yb = $layout->getCurrentCursor()->getY() + $template->getHeightInRows();

        if ($xb > $layout->getRows()) {
            return false;
        }

        if ($yb > $layout->getRows()) {
            return false;
        }
        return true;
    }
}