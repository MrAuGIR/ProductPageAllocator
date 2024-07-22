<?php
namespace MrAuGir\Paginator;
use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

interface PageInterface
{

    public function getFreeSLots():int;

    public function getCurrentCursor(): array;

    public function addTemplate(TemplatePaginatorInterface $template):self;
}