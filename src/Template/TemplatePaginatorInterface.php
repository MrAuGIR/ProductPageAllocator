<?php
namespace MrAuGir\Paginator\Template;
interface TemplatePaginatorInterface
{
    public function getSlots():int;

    public function getLenthInColumn():int;

    public function getHeightInRows():int;
}