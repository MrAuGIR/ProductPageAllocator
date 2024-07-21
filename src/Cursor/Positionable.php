<?php

namespace MrAuGir\Paginator\Cursor;

interface Positionable
{
    public function getX(): int;

    public function getY(): int;

    public function upX(int $x): self;

    public function downX(int $x): self;

    public function upY(int $y): self;

    public function downY(int $y): self;

    public function resetX(): self;

    public function resetY(): self;
}