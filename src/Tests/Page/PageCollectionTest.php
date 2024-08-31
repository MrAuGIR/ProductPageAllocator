<?php

namespace MrAuGir\Paginator\Tests\Page;

use MrAuGir\Paginator\Page\Page;
use MrAuGir\Paginator\Page\PageCollection;
use PHPUnit\Framework\TestCase;

class PageCollectionTest extends TestCase
{
    public function testConstructor()
    {
        $collection = new PageCollection();
        $this->assertEquals(0, $collection->count());
    }

    public function testAddPage()
    {
        $pageCollection = new PageCollection();
        $page = new Page();
        $page->index = 1;

        $pageCollection->addPage($page);

        $this->assertCount(1, $pageCollection);
        $this->assertSame($page, $pageCollection[1]);
    }

    public function testGetOrCreatePage()
    {
        $pageCollection = new PageCollection();
        $index = 2;

        // Get or create a page
        $page = $pageCollection->getOrCreatePage($index);

        $this->assertInstanceOf(Page::class, $page);
        $this->assertEquals($index, $page->index);
        $this->assertCount(1, $pageCollection);

        // Ensure the same page is returned for the same index
        $samePage = $pageCollection->getOrCreatePage($index);
        $this->assertSame($page, $samePage);
    }

    public function testRemovePage()
    {
        $pageCollection = new PageCollection();
        $page = new Page();
        $page->index = 1;

        $pageCollection->addPage($page);

        $this->assertCount(1, $pageCollection);

        // Remove the page
        $pageCollection->removePage(1);

        $this->assertCount(0, $pageCollection);
        $this->assertFalse($pageCollection->hasPage(1));
    }

    public function testHasPage()
    {
        $pageCollection = new PageCollection();
        $page = new Page();
        $page->index = 1;

        $pageCollection->addPage($page);

        $this->assertTrue($pageCollection->hasPage(1));
        $this->assertFalse($pageCollection->hasPage(2));
    }

    public function testOffsetSetAndGet()
    {
        $pageCollection = new PageCollection();
        $page = new Page();
        $page->index = 1;

        // Test ArrayAccess functionality
        $pageCollection[1] = $page;

        $this->assertSame($page, $pageCollection[1]);
    }

    public function testOffsetUnset()
    {
        $pageCollection = new PageCollection();
        $page = new Page();
        $page->index = 1;

        $pageCollection->addPage($page);

        // Ensure page is added
        $this->assertTrue($pageCollection->hasPage(1));

        // Unset the page
        unset($pageCollection[1]);

        // Ensure page is removed
        $this->assertFalse($pageCollection->hasPage(1));
    }

    public function testCount()
    {
        $pageCollection = new PageCollection();
        $page1 = new Page();
        $page1->index = 1;
        $page2 = new Page();
        $page2->index = 2;

        $pageCollection->addPage($page1);
        $pageCollection->addPage($page2);

        $this->assertCount(2, $pageCollection);
    }
}