<?php

namespace MrAuGir\ElementGridAllocation\Grid;

class NodeCollection
{
    /**
     * @var Node[][]
     */
    private array $nodes;

    public function __construct(int $numberCols, int $numberRows)
    {
        $this->initNodes($numberCols, $numberRows);
    }

    public function initNodes(int $numberCols, int $numberRows): void
    {
        for ($i = 0; $i < $numberRows; $i++) {
            for ($j = 0; $j < $numberCols; $j++) {
                $this->nodes[$i][$j] = (new Node())->setX($j)->setY($i)->setStatus("");
            }
        }
    }

    public function getNode(int $col, int $row): ?Node
    {
        if (!$this->isWithinBounds($col, $row)) {
            throw new \InvalidArgumentException('Invalid node position: (' . $col . ', ' . $row . ').');
        }
        return $this->nodes[$row][$col] ?? null;
    }


    public function updateNode(int $col,int $row, string $status, string $color = ''): self
    {
        if (!$this->isWithinBounds($col, $row)) {
            throw new \InvalidArgumentException('Invalid node position: (' . $col . ', ' . $row . ').');
        }
        $this->nodes[$row][$col]->setStatus($status)->setColor($color);
        return $this;
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
        if ($col < 0 || empty($this->nodes[0]) || $col >= count($this->nodes[0])) {
            throw new \InvalidArgumentException('Invalid column index: ' . $col);
        }
        return array_map(static fn($row) => $row[$col], $this->nodes);
    }

    public function getFlatNodes(): array
    {
        return array_merge(...$this->nodes);
    }

    private function isWithinBounds(int $col, int $row): bool
    {
        return $row >= 0 && $row < count($this->nodes) && $col >= 0 && $col < count($this->nodes[0]);
    }
}
