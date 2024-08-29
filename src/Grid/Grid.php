<?php

namespace MrAuGir\Paginator\Grid;

use MrAuGir\Paginator\Page\PageCollection;
use MrAuGir\Paginator\Template\GridElementInterface;

class Grid
{
    private NodeCollection $nodes;
    public function __construct(
        private readonly int $rows,
        private readonly int $cols
    )
    {
        $this->nodes = new NodeCollection($cols,$rows);
    }


    public function getNodes(): NodeCollection
    {
        return $this->nodes;
    }

    public function findPositionForBlock(GridElementInterface $block, PageCollection $pageCollection): void
    {
        $indexPage = 1;
        foreach ($this->getNodes()->getNodes() as $indexRow => $row) {
            foreach ($row as $indexCol => $node) {
                if ($this->canPlaceBlock($block,$indexRow,$indexCol)) {
                    $block->setX($indexCol);
                    $block->setY($indexRow);
                    $this->updateNodes($block);
                    $page = $pageCollection->getOrCreatePage($indexPage);
                    $page->addBlock($block);
                    $page->setGrid($this->copy());
                    return;
                }
            }
        }

        // si on n'arrive pas a positionné le block on yield la page
        $this->nodes->initNodes($this->cols,$this->rows);
        $indexPage += 1;
        if (!empty($position = $this->searchAvailablePosition($block))) {
            $block->setX($position['col']);
            $block->setY($position['row']);
            $this->updateNodes($block);
            $page = $pageCollection->getOrCreatePage($indexPage);
            $page->addBlock($block);
            $page->setGrid($this->copy());
        }
    }

    private function searchAvailablePosition(GridElementInterface $block): ?array
    {
        foreach ($this->getNodes()->getNodes() as $indexRow => $row) {
            foreach ($row as $indexCol => $node) {
                if ($this->canPlaceBlock($block,$indexRow,$indexCol)) {
                    return ['col' => $indexCol,'row' => $indexRow];
                }
            }
        }
        return null;
    }

    private function canPlaceBlock(GridElementInterface $block,int $indexRow,int $indexCol): bool
    {
        for ($jBlock = 0; $jBlock < $block->getRows(); $jBlock++ ) {

            for($iBlock = 0; $iBlock < $block->getCols(); $iBlock++) {

                if (!$this->validatePlace($indexCol + $iBlock, $indexRow + $jBlock)) {
                    return false;
                }
            }
        }
        return true;
    }

    private function updateNodes(GridElementInterface $block) :void
    {
        $colorBlock = $this->generateRandomColor();
        for ($iBlock = $block->getY(); $iBlock < ($block->getY() + $block->getRows()); $iBlock++ ) {

            for ($jBlock = $block->getX(); $jBlock < ($block->getX() + $block->getCols()); $jBlock++) {

                $this->nodes->updateNode($jBlock,$iBlock,'X',$colorBlock);
            }
        }
    }

    private function generateRandomColor(): string {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    private function validatePlace(int $length, int $height):bool {
        if ($length >= $this->cols) {
            return false;
        }

        if ($height >= $this->rows) {
            return false;
        }

        if ($this->nodes->getNodes()[$height][$length]->getStatus() === 'X') {
            return false;
        }

        return true;
    }


    private function copy(): self
    {
        $grid = new Grid($this->rows,$this->cols);
        $grid->nodes = clone $this->nodes;

        return $grid;
    }
}
