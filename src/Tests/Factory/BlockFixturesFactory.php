<?php

namespace MrAuGir\ElementGridAllocation\Tests\Factory;

use MrAuGir\ElementGridAllocation\Grid\Block;

class BlockFixturesFactory
{
    public static function create(int $col,int $row): Block
    {
        return new Block($col, $row);
    }
}