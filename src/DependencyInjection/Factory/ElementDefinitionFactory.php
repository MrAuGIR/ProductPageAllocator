<?php

namespace MrAuGir\ElementGridAllocation\DependencyInjection\Factory;

use MrAuGir\ElementGridAllocation\Template\GridElementInterface;
use Symfony\Component\DependencyInjection\Definition;

class ElementDefinitionFactory
{
    public function create(string $id, array $config): ?Definition
    {
        $definition = new Definition();
        $definition->setClass(GridElementInterface::class);
        $definition->setPublic(true);
        $definition->setAutowired(true);

        return $definition;
    }
}