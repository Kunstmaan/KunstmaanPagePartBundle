<?php

namespace Kunstmaan\PagePartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see
 * {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kunstmaan_page_part');

        $rootNode
            ->children()
                ->arrayNode('link_page_part')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('devitize_filter')
                            ->defaultValue(false)
                            ->info('convert all linkPagePart urls into app_dev.php (when running in dev)')
                            ->end()
                        ->scalarNode('devitize_index')
                            ->defaultValue('app_dev.php')
                            ->info('the new index file')
                            ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
