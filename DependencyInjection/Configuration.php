<?php

namespace Proximity\ActiveDirectoryUserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('prox_ad_user');

        $rootNode
            ->children()
                ->scalarNode('ldap_host')->isRequired()->end()
                ->scalarNode('organizational_unit')->isRequired()->end()
                ->arrayNode('domain_components')
                    ->prototype('scalar')->end()
                ->end()
            ->end();


        return $treeBuilder;
    }
}
