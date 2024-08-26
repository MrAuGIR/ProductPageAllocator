<?php

namespace MrAuGir\Paginator\Tests\Factory;

use MrAuGir\Paginator\Grid\Block;

class BlockFixturesFactory
{
    public static function create(int $col,int $row): Block
    {
        return new Block($col, $row);
    }
}