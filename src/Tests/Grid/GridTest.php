<?php

namespace MrAuGir\Paginator\Tests\Grid;


use MrAuGir\Paginator\Grid\Block;
use MrAuGir\Paginator\Grid\Grid;
use MrAuGir\Paginator\Page\PageCollection;
use MrAuGir\Paginator\Tests\Factory\GridFixturesFactory;
use MrAuGir\Paginator\Tests\Factory\BlockFixturesFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testConstructGrid():void
    {
        $grid = new Grid(10,8);

        $this->assertCount(10 * 8, $grid->getNodes()->getFlatNodes());
    }

    public function testAddFirstBlock():void
    {
        $grid = GridFixturesFactory::create(10,8);

        $block = BlockFixturesFactory::create(8,2);

        $pageCollection = new PageCollection();

        $grid->findPositionForBlock($block, $pageCollection);

        // une seule page doit exister
        $this->assertCount(1,$pageCollection->pages);

        // l'index doit être un 1
        $this->assertNotNull($pageCollection->pages[1]);
        $this->assertEquals(1,$pageCollection->pages[1]->index);

        $blocks = $pageCollection->getOrCreatePage(1)->getBlocks();

        $this->assertCount(1, $blocks);
        $block = $blocks[0];

        $this->assertInstanceOf(Block::class, $block);
        $this->assertEquals(8, $block->getCols());
        $this->assertEquals(2, $block->getRows());
        $this->assertEquals(0, $block->getY());
        $this->assertEquals(0, $block->getX());
    }

    public function testCanAddBlock(): void
    {
        $grid = GridFixturesFactory::create(10,8);

        $block = BlockFixturesFactory::create(11,2);

        $pageCollection = new PageCollection();

        $grid->findPositionForBlock($block, $pageCollection);

        // l'index 1 doit être empty
        $this->assertNull($pageCollection->pages[1] ?? null);

        $blocks = $pageCollection->getOrCreatePage(1)->getBlocks();

        $this->assertCount(0, $blocks);
    }


    public function testAddMultipleBlocks():void
    {
        $grid = GridFixturesFactory::create(10,8);
        $pageCollection = new PageCollection();

        foreach (self::blocksCollectionProvider() as $block) {
            $grid->findPositionForBlock($block, $pageCollection);
        }

        // on doit trouver deux pages
        $this->assertCount(2, $pageCollection->pages);

        // il doit avoir trois blocks sur la première page et 1 block sur la seconde
        $this->testResult($pageCollection,1,3);
        $this->testResult($pageCollection,2,1);
    }

    public static function blocksCollectionProvider(): array
    {
        return [
            BlockFixturesFactory::create(8,2),
            BlockFixturesFactory::create(4,2),
            BlockFixturesFactory::create(4,2),
            BlockFixturesFactory::create(8,7),
        ];
    }

    private function testResult(PageCollection $pageCollection,int $index, int $blockExpected): void
    {
        $this->assertCount($blockExpected, $pageCollection->pages[$index]->blocks);
        $this->assertEquals($index, $pageCollection->pages[$index]->index);
    }
}
