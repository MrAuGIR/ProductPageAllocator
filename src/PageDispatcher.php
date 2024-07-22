<?php

namespace MrAuGir\Paginator;

use ActivePublishing\Pim2PrintInterface\Classes\Page;
use MrAuGir\Paginator\Layout\LayoutPaginatorInterface;
use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

class PageDispatcher
{
    /**
     * @param array $items
     * @param LayoutPaginatorInterface $layout
     * @return iterable
     */
    public function dispatch(array $items,LayoutPaginatorInterface $layout): iterable
    {
        $validator = new Validator();
        $GridNavigator = new GridNavigator();

        foreach ($items as $item) {
            if (!$validator->validateSlot($item,$layout)) {

            }
        }
    }
}