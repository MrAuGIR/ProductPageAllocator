<?php

namespace MrAuGir\Paginator\Tests\Factory;

use MrAuGir\Paginator\Grid\Grid;

class GridFixturesFactory
{
    public static function create(int $col, int $row): Grid
    {
        return new Grid($col, $row);
    }
}