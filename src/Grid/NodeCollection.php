<?php

namespace MrAuGir\Paginator\Grid;

class NodeCollection
{
    /**
     * @var Node[][]
     */
    private array $nodes;

    public function initNodes(int $numberCols, int $numberRows): self
    {
        for ($i = 0; $i < $numberRows; $i++) {
            for ($j = 0; $j < $numberCols; $j++) {
                $this->nodes[$i][$j] = (new Node())->setX($j)->setY($i)->setStatus("");
            }
        }

        return $this;
    }

    public function getNode(int $col, int $row): ?Node
    {
        return $this->nodes[$row][$col] ?? null;
    }

    /**
     * @return Node[][]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param int $row
     * @return array|Node[]
     */
    public function getRow(int $row): array
    {
        return $this->nodes[$row] ?? [];
    }

    /**
     * @param int $col
     * @return Node[]
     */
    public function getCol(int $col): array
    {
        $return = [];

        foreach ($this->nodes as $i => $row) {
            foreach ($row as $j => $node) {
                if ($j == $col) {
                    $return[] = $node;
                }
            }
        }
        return $return;
    }

    public function updateNode(int $col,int $row, string $status, string $color = ''): self
    {
        $this->nodes[$row][$col]->status = $status;
        $this->nodes[$row][$col]->color = $color;
        return $this;
    }

    public function getFlatNodes(): array
    {
        $flatArray = [];

        array_walk_recursive($this->nodes, function($a) use (&$flatArray) {
            $flatArray[] = $a;
        });

        return $flatArray;
    }
}
