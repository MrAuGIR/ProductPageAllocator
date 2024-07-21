<?php

namespace MrAuGir\Paginator\Layout;

class LayoutFactory
{
    public static function create(int $columns, int $rows): LayoutPaginatorInterface
    {
        return new DefaultLayout($columns, $rows);
    }
}