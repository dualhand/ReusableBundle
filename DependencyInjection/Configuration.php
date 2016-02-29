<?php

namespace Acme\ReusableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\NodeInterface;

class Configuration implements ConfigurationInterface
{
    const PRODUCT_CLASS = 'Acme\ReusableBundle\Model\Product';
    const CART_CLASS = 'Acme\ReusableBundle\Model\Cart';
    const CART_LINE_CLASS = 'Acme\ReusableBundle\Model\CartLine';
    const MODEL_MANAGER_NAME = 'default';
    const ORM_ENABLED = true;

    /**
     * Generates the configuration tree.
     *
     * @return NodeInterface
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('acme_reusable')
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('product')->cannotBeEmpty()->defaultValue(self::PRODUCT_CLASS)->end()
                        ->scalarNode('cart')->cannotBeEmpty()->defaultValue(self::CART_CLASS)->end()
                        ->scalarNode('cart_line')->cannotBeEmpty()->defaultValue(self::CART_LINE_CLASS)->end()
                        ->arrayNode('purchasable_mapping')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('key')->end()
                                    ->scalarNode('class')->end()
                                ->end()
                            ->end()
                        ->end()

                    ->end()
                ->end()
                ->scalarNode('model_manager_name')->defaultValue(self::MODEL_MANAGER_NAME)->end()
                ->booleanNode('orm_enabled')->defaultValue(self::ORM_ENABLED)->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
