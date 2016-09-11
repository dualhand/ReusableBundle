<?php

namespace DualHand\ReusableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\NodeInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    const CART_CLASS = 'DualHand\ReusableBundle\Model\Cart';
    const CART_LINE_CLASS = 'DualHand\ReusableBundle\Model\CartLine';
    const MODEL_MANAGER_NAME = 'default';
    const ORM_ENABLED = true;
    const PURCHASABLE_FORM_TYPE_CLASS = 'Acme\ReusableBundle\Form\PurchasableType';

    /**
     * Generates the configuration tree.
     *
     * @return NodeInterface
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('dual_hand_reusable')
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
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

                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('purchasable')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type_class')->cannotBeEmpty()->defaultValue(self::PURCHASABLE_FORM_TYPE_CLASS)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
