<?php

namespace MrAuGir\Paginator\Tests\Grid;

use Monolog\Test\TestCase;
use MrAuGir\Paginator\Grid\Node;
use MrAuGir\Paginator\Grid\NodeCollection;

class NodeCollectionTest extends TestCase
{

    public function testGetNodeThrowsExceptionForInvalidPosition(): void
    {
        $cols = 5;
        $rows = 5;
        $nodeCollection = new NodeCollection($cols, $rows);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (10, 0).');
        $nodeCollection->getNode(10, 0);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (0, 10).');
        $nodeCollection->getNode(0, 10);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (-1, 0).');
        $nodeCollection->getNode(-1, 0);
    }

    public function testUpdateNodeThrowsExceptionForInvalidPosition(): void
    {
        $cols = 5;
        $rows = 5;
        $nodeCollection = new NodeCollection($cols, $rows);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (10, 0).');
        $nodeCollection->updateNode(10, 0, 'X');


        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (0, 10).');
        $nodeCollection->updateNode(0, 10, 'X');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid node position: (-1, 0).');
        $nodeCollection->updateNode(-1, 0, 'X');
    }

    public function testGetNodeReturnsCorrectNode(): void
    {
        $cols = 3;
        $rows = 3;
        $nodeCollection = new NodeCollection($cols, $rows);

        $node = $nodeCollection->getNode(1, 1);
        $this->assertInstanceOf(Node::class, $node);
        $this->assertEquals(1, $node->getX());
        $this->assertEquals(1, $node->getY());
        $this->assertEquals('', $node->getStatus());
    }

    public function testUpdateNodeUpdatesCorrectNode(): void
    {
        $cols = 3;
        $rows = 3;
        $nodeCollection = new NodeCollection($cols, $rows);

        $nodeCollection->updateNode(1, 1, 'X', '#000000');

        $node = $nodeCollection->getNode(1, 1);
        $this->assertEquals('X', $node->getStatus());
        $this->assertEquals('#000000', $node->getColor());
    }

    public function testGetColReturnsCorrectColumn(): void
    {
        $cols = 3;
        $rows = 3;
        $nodeCollection = new NodeCollection($cols, $rows);

        $column = $nodeCollection->getCol(1);

        $this->assertCount(3, $column);
        foreach ($column as $node) {
            $this->assertInstanceOf(Node::class, $node);
            $this->assertEquals(1, $node->getX());
        }
    }

    public function testGetRowReturnsCorrectRow(): void
    {
        $cols = 3;
        $rows = 3;
        $nodeCollection = new NodeCollection($cols, $rows);

        $row = $nodeCollection->getRow(1);

        $this->assertCount(3, $row);
        foreach ($row as $node) {
            $this->assertInstanceOf(Node::class, $node);
            $this->assertEquals(1, $node->getY());
        }
    }
}