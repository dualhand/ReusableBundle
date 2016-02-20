<?php

namespace ReusableBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ReusableBundle extends Bundle
{

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $this->buildOrmCompilerPass($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function buildOrmCompilerPass(ContainerBuilder $container)
    {
        $arguments = array(array(realpath(__DIR__.'/Resources/config/doctrine-model')), '.orm.xml');
        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\DefaultFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\XmlDriver', array($locator));

        foreach ($this->extension->getEntitiesOverrides() as $configKey => $entity) {

            $container->addCompilerPass(
                new DoctrineOrmMappingsPass(
                    $driver,
                    array("%grb.$configKey.class%"),
                    array('grb.model_manager_name', 'orm'),
                    "grb.use_default.$configKey"
                )
            );
        }
    }

}