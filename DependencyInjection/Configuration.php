<?php

namespace Rid\Bundle\PageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rid_page');

        $rootNode
            ->children()
                ->arrayNode('template')
                    ->children()
                        ->scalarNode('layout')->defaultValue('::base.html.twig')
                        ->end()
                        ->scalarNode('list')->defaultValue('RidPageBundle:Page:list.html.twig')
                        ->end()
                        ->scalarNode('show')->defaultValue('RidPageBundle:Page:show.html.twig')
                        ->end()
                        ->scalarNode('render')->defaultValue('RidPageBundle:Page/partials:_render.html.twig')
                        ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        return $treeBuilder;
    }
}
