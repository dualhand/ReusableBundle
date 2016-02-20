<?php

namespace ReusableBundle\DependencyInjection;

use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ReusableExtension extends Extension implements PrependExtensionInterface
{

    public function getEntitiesOverrides()
    {
        return
            array(
                'product' => Configuration::PRODUCT_CLASS,
                'cart' => Configuration::CART_CLASS,
                'cart_line' => Configuration::CART_LINE_CLASS,
        );
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

        $this->addDoctrineDiscriminators($config);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.yml');

    }


    /**
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function setConfiguration(ContainerBuilder $container, $config)
    {
        $container->setParameter('grb.model_manager_name', $config['model_manager_name']);
        $container->setParameter('grb.orm_enabled', $config['orm_enabled']);

        $this->configureClass($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function configureClass(ContainerBuilder $container, $config)
    {
        $defaultClasses = $this->getEntitiesOverrides();

        foreach ($defaultClasses as $configKey => $entity) {

            $container->setParameter("grb.$configKey.class", $config['class'][$configKey]);

            $container->setParameter("grb.use_default.$configKey",
                ($config['class'][$configKey] == $defaultClasses[$configKey]
                    && $config['orm_enabled'])
            );

        }

    }

    /**
     * @param array $config
     *
     * @throws \Exception
     */
    protected function addDoctrineDiscriminators(array $config)
    {
        $collector = DoctrineCollector::getInstance();
        $purchasableClass = 'ReusableBundle\Entity\Abstracts\AbstractPurchasable';

        $collector->addDiscriminator($purchasableClass, 'PROD', $config['class']['product']);

        $types = $config['class']['purchasable_mapping'];
        foreach ($types as $type) {
            list($key, $class) = array_values($type);

            if (!class_exists($class)) {
                throw new \Exception(sprintf('Class %s not found', $class));
            }

            //Add custom type
            $collector->addDiscriminator($purchasableClass, $key, $class);
        }
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
                    'ReusableBundle\Model\Interfaces\CartInterface' => $config['class']['cart']
                ),
            ),
        );

        if (isset($bundles['DoctrineBundle'])) {
            $container->prependExtensionConfig('doctrine', $doctrineConfig);
        }

    }
}
