<?php

namespace MrAuGir\Paginator\Tests;


use MrAuGir\Paginator\Grid\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testConstructGrid():void
    {
        $grid = new Grid(10,8);

        $this->assertCount(10 * 8, $grid->getNodes()->getFlatNodes());
    }
}
