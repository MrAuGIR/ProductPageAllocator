<?php

namespace MrAuGir\ElementGridAllocation\DependencyInjection\Factory;

use MrAuGir\ElementGridAllocation\Grid\Grid;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GridDefinitionFactory
{
    public function create(string $id,array $config): ?Definition
    {
        $definition = new Definition();
        $definition->setClass(Grid::class);
        $definition->setPublic(true);
        $definition->setAutowired(true);
        $definition->addArgument($config['rows']);
        $definition->addArgument($config['cols']);

        return $definition;
    }

}