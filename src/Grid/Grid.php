<?php

namespace MrAuGir\Paginator\Grid;

class Grid
{
    private NodeCollection $nodes;
    public function __construct(
        private int $rows,
        private int $cols
    )
    {
        $this->nodes = new NodeCollection();
        $this->nodes->initNodes($cols,$rows);
    }


    public function getNodes(): array
    {
        return $this->nodes->getNodes();
    }

    public function findPositionForBlock(Block $block, array &$pages): void
    {
        $indexPage = 1;
        foreach ($this->getNodes() as $indexRow => $row) {
            foreach ($row as $indexCol => $node) {
                if ($this->canPlaceBlock($block,$indexRow,$indexCol)) {
                    $block->setX($indexCol);
                    $block->setY($indexRow);
                    $this->updateNodes($block);
                    $pages[$indexPage][] = $block;
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
            $pages[$indexPage][] = $block;
        }

    }

    private function searchAvailablePosition(Block $block): ?array
    {
        foreach ($this->getNodes() as $indexRow => $row) {
            foreach ($row as $indexCol => $node) {
                if ($this->canPlaceBlock($block,$indexRow,$indexCol)) {
                    return ['col' => $indexCol,'row' => $indexRow];
                }
            }
        }
        return null;
    }

    private function canPlaceBlock(Block $block,int $indexRow,int $indexCol): bool
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

    private function updateNodes(Block $block) :void
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

        if ($this->nodes->getNodes()[$height][$length]->status === 'X') {
            return false;
        }

        return true;
    }

}
