<?php

namespace MrAuGir\Paginator\Tests\Page;

use MrAuGir\Paginator\Page\PageCollection;
use PHPUnit\Framework\TestCase;

class PageCollectionTest extends TestCase
{
    public function testConstructor()
    {
        $collection = new PageCollection();
        $this->assertEquals(0, $collection->count());
    }
}