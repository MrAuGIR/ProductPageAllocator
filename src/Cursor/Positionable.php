<?php

namespace MrAuGir\Paginator\Cursor;

interface Positionable
{
    public function getX(): int;

    public function getY(): int;
}