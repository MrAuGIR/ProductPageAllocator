<?php

namespace MrAuGir\ElementGridAllocation\Grid;

use MrAuGir\ElementGridAllocation\Template\GridElementInterface;

class Block implements GridElementInterface
{
    private int $x;

    private int $y;

    public function __construct(
        private int $cols,
        private int $rows
    ){}

    public function getCols(): int
    {
        return $this->cols;
    }

    public function setCols(int $cols): void
    {
        $this->cols = $cols;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function setRows(int $rows): void
    {
        $this->rows = $rows;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }
}
