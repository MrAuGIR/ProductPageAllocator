<?php

namespace MrAuGir\ElementGridAllocation\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder("element_grid_allocation");

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->fixXmlConfig('grid')
            ->children()
                ->arrayNode('grids')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->integerNode('cols')->end()
                            ->integerNode('rows')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('dispatchers')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('grid')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('elements')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->integerNode('rows')->end()
                            ->integerNode('cols')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}