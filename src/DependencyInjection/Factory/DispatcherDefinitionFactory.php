<?php

namespace MrAuGir\ElementGridAllocation\DependencyInjection\Factory;

use MrAuGir\ElementGridAllocation\PageDispatcher;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class DispatcherDefinitionFactory
{
    public function create(string $id, array $config): ?Definition
    {
        $definition = new Definition();
        $definition->setClass(PageDispatcher::class);
        $definition->setPublic(true);
        $definition->setAutowired(true);

        $alias =  sprintf('allocation.grid.%s', $config['grid']);
        $definition->addMethodCall('initGrid',[new Reference($alias)]);

        return $definition;
    }
}