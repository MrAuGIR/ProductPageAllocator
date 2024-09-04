<?php

namespace MrAuGir\ElementGridAllocation\Template;

use MrAuGir\ElementGridAllocation\Grid\Block;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class ElementEngine
{
    public function __construct(
        #[TaggedIterator('mraugir.allocation.element')] private iterable $elements
    ){}

    public function getLinkedElements(object $data): GridElementInterface
    {
        // TODO

        return new Block(8,10); // temporaire
    }
}