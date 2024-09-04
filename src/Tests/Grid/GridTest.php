<?php

namespace MrAuGir\ElementGridAllocation\Tests\Grid;


use MrAuGir\ElementGridAllocation\Grid\Block;
use MrAuGir\ElementGridAllocation\Grid\Grid;
use MrAuGir\ElementGridAllocation\Page\PageCollection;
use MrAuGir\ElementGridAllocation\Tests\Factory\BlockFixturesFactory;
use MrAuGir\ElementGridAllocation\Tests\Factory\GridFixturesFactory;
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
        $this->assertCount(1,$pageCollection->getPages());

        // l'index doit être un 1
        $this->assertNotNull($pageCollection->getPages()[1]);
        $this->assertEquals(1,$pageCollection->getPages()[1]->index);

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
        // test interface array access
        $this->assertNull($pageCollection[1] ?? null);

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
        $this->assertCount(2, $pageCollection->getPages());
        // test coutable interface
        $this->assertCOunt(2,$pageCollection);

        // il doit avoir trois blocks sur la première page et 1 block sur la seconde
        $this->testResult($pageCollection,1,3);
        $this->testResult($pageCollection,2,1);
    }

    public function testOffsetPageCollection():void
    {
        $this->expectException(\InvalidArgumentException::class);

        $pageCollection = new PageCollection();
        $pageCollection[0] = 'InvalidType';

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

    public static function collectionProvider(): array
    {
        return [
            0 => [
                [
                    BlockFixturesFactory::create(8,2),
                    BlockFixturesFactory::create(4,2),
                    BlockFixturesFactory::create(4,2),
                ],
                1
            ],
            1 => [
                [
                    BlockFixturesFactory::create(8,5),
                    BlockFixturesFactory::create(8,5),
                    BlockFixturesFactory::create(8,10),
                ],
                2,
            ],
            2 => [
                [
                    BlockFixturesFactory::create(2,10),
                    BlockFixturesFactory::create(2,10),
                    BlockFixturesFactory::create(2,10),
                    BlockFixturesFactory::create(2,10),
                ],
                1
            ]

        ];
    }

    #[DataProvider('collectionProvider')]
    public function testProvider(array $blocks,$nbPages):void
    {
        // TODO
        $grid = GridFixturesFactory::create(10,8);
        $pageCollection = new PageCollection();

        foreach ($blocks as $block) {
            $grid->findPositionForBlock($block, $pageCollection);
        }

        $this->assertCount($nbPages, $pageCollection);
    }



    private function testResult(PageCollection $pageCollection,int $index, int $blockExpected): void
    {
        $this->assertCount($blockExpected, $pageCollection->getPages()[$index]->blocks);
        $this->assertEquals($index, $pageCollection->getPages()[$index]->index);
    }
}
