<?php

namespace MrAuGir\Paginator\Cursor;

class Cursor implements Positionable
{
    public function __construct(
        public int $x,
        public int $y
    )
    {
    }

    public function toArray(): array
    {
        return [$this->x, $this->y];
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}