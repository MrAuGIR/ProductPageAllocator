<?php

namespace MrAuGir\ElementGridAllocation\Template;

interface GridElementInterface
{
    public function getCols(): int;

    public function setCols(int $cols): void;

    public function getRows(): int;

    public function setRows(int $rows): void;
    public function getX(): int;

    public function setX(int $x): void;
    public function getY(): int;

    public function setY(int $y): void;
}
