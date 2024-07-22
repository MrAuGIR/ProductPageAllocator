<?php

namespace MrAuGir\Paginator\Tests;

use MrAuGir\Paginator\GridNavigator;
use MrAuGir\Paginator\Layout\LayoutFactory;
use MrAuGir\Paginator\Tests\objects\TemplateFaker;
use PHPUnit\Framework\TestCase;

class GridNavigatorTest extends TestCase
{
    public function testMoveCursor(): void
    {
        $navigator = new GridNavigator();

        $layout = LayoutFactory::create(8,8);

        $template = TemplateFaker::create(4,2);

        $navigator->moveOnLineCursor($layout->getCurrentCursor(), $template);

        $this->assertEquals(4,$layout->getCurrentCursor()->getX());
        $this->assertEquals(0,$layout->getCurrentCursor()->getY());
    }
}