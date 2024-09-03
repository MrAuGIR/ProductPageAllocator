<?php

namespace MrAuGir\ElementGridAllocation\Tests\Factory;

use MrAuGir\ElementGridAllocation\Grid\Grid;

class GridFixturesFactory
{
    public static function create(int $col, int $row): Grid
    {
        return new Grid($col, $row);
    }
}