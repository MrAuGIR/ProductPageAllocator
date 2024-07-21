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

    public function upX(int $x): Positionable
    {
        $this->x += $x;
        return $this;
    }

    public function downX(int $x): Positionable
    {
        $this->x -= $x;
        return $this;
    }

    public function upY(int $y): Positionable
    {
        $this->y += $y;
        return $this;
    }

    public function downY(int $y): Positionable
    {
        $this->y -= $y;
        return $this;
    }

    public function resetX(): Positionable
    {
        $this->x = 0;
        return $this;
    }

    public function resetY(): Positionable
    {
        $this->y = 0;
        return $this;
    }
}