<?php

namespace DualHand\ReusableBundle\DependencyInjection;

use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class DualHandReusableExtension.
 */
class DualHandReusableExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @return array
     */
    public function getEntitiesOverrides()
    {
        return
            array(
                'cart' => Configuration::CART_CLASS,
                'cart_line' => Configuration::CART_LINE_CLASS,
        );
    }

    public function getFormsOverrides()
    {
        return array('purchasable');
    }

    /**
     * Loads and processes configuration to configure the Container.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->setConfiguration($container, $config);
        
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.yml');
    }

    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');

        $doctrineConfig = array(
            'orm' => array(
                'resolve_target_entities' => array(
                    'DualHand\ReusableBundle\Entity\Interfaces\CartInterface' => $config['class']['cart'],
                ),
            ),
        );

        if (isset($bundles['DoctrineBundle'])) {
            $container->prependExtensionConfig('doctrine', $doctrineConfig);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function setConfiguration(ContainerBuilder $container, $config)
    {
        $container->setParameter('DualHand_reusable.model_manager_name', $config['model_manager_name']);
        $container->setParameter('DualHand_reusable.orm_enabled', $config['orm_enabled']);

        $this->configureClass($container, $config);
        $this->configureForm($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function configureClass(ContainerBuilder $container, $config)
    {
        $defaultClasses = $this->getEntitiesOverrides();

        foreach ($defaultClasses as $configKey => $entity) {
            $container->setParameter("DualHand_reusable.$configKey.class", $config['class'][$configKey]);

            $container->setParameter(
                "DualHand_reusable.use_default.$configKey",
                ($config['class'][$configKey] == $defaultClasses[$configKey] && $config['orm_enabled'])
            );
        }

        $purchasableMap = array();
        foreach ($config['class']['purchasable_mapping'] as $discriminator) {
            $purchasableMap[$discriminator['key']] = $discriminator['class'];
        }

        $container->setParameter("DualHand_reusable.purchasable_map", $purchasableMap);
    }

    protected function configureForm(ContainerBuilder $container, $config)
    {
        $forms = $this->getFormsOverrides();

        foreach ($forms as $form) {
            $container->setParameter("acme_reusable.form.$form.type_class", $config['form'][$form]['type_class']);
        }
    }
}
