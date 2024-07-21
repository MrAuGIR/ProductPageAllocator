<?php
namespace MrAuGir\Paginator;
interface PageInterface
{
    public function getFreeSLots():int;

    public function getCurrentCursor(): array;
}