<?php

namespace MrAuGir\ElementGridAllocation\DependencyInjection;

use MrAuGir\ElementGridAllocation\DependencyInjection\Factory\DispatcherDefinitionFactory;
use MrAuGir\ElementGridAllocation\DependencyInjection\Factory\ElementDefinitionFactory;
use MrAuGir\ElementGridAllocation\DependencyInjection\Factory\GridDefinitionFactory;
use MrAuGir\ElementGridAllocation\Grid\Grid;
use MrAuGir\ElementGridAllocation\Template\GridElementInterface;
use PHPUnit\Event\Dispatcher;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ElementGridAllocationExtension extends Extension
{

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new COnfiguration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $this->createGridsDefinition($container,$config['grids']);
        $this->createDispatcherDefinition($container,$config['dispatchers']);
        $this->createElementGridDefinition($container,$config['elements']);
    }

    private function createGridsDefinition(ContainerBuilder $container, array $grids): void
    {
        $definitionFactory = new GridDefinitionFactory();

        foreach ($grids as $id => $conf) {
            $definition = $definitionFactory->create($id,$conf);
            $definition->addTag("mraugir.allocation.grid");
            $alias =  sprintf('allocation.grid.%s', $id);
            $container->setDefinition($id,$definition);
            $container->setDefinition($alias,$definition);
            $container->registerAliasForArgument($id, Grid::class, $id)->setPublic(false);
        }
    }

    private function createDispatcherDefinition(ContainerBuilder $container, array $dispatchers): void
    {
        $definitionFactory = new DispatcherDefinitionFactory();

        foreach ($dispatchers as $id => $conf) {
            $definition = $definitionFactory->create($id,$conf);
            $definition->addTag('mraugir.allocation.dispatcher');
            $alias = sprintf('allocation.dispatcher.%s', $id);
            $container->setDefinition($id,$definition);
            $container->setDefinition($alias,$definition);
            $container->registerAliasForArgument($id, Dispatcher::class, $id)->setPublic(false);
        }
    }

    private function createElementGridDefinition(ContainerBuilder $container,array $elements): void
    {
        $definitionFactory = new ElementDefinitionFactory();

        foreach ($elements as $id => $conf) {
            $definition = $definitionFactory->create($id,$conf);
            $definition->addTag('mraugir.allocation.element');
            $alias = sprintf('allocation.element.%s', $id);
            $container->setDefinition($id,$definition);
            $container->setDefinition($alias,$definition);
            $container->registerAliasForArgument($id, GridElementInterface::class, $id)->setPublic(false);
        }
    }
}