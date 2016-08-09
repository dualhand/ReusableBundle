<?php

namespace Acme\ReusableBundle;

use Acme\ReusableBundle\DependencyInjection\AcmeReusableExtension;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AcmeReusableBundle.
 */
class AcmeReusableBundle extends Bundle
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
     * @return AcmeReusableExtension
     */
    public function getContainerExtension()
    {
        return new AcmeReusableExtension();
    }

    /**
     * @param ContainerBuilder $container
     */
    private function buildOrmCompilerPass(ContainerBuilder $container)
    {
        $arguments = array(array(realpath(__DIR__.'/Resources/config/doctrine-model')), '.orm.xml');
        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\DefaultFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\XmlDriver', array($locator));

        foreach ($this->getContainerExtension()->getEntitiesOverrides() as $configKey => $entity) {
            $container->addCompilerPass(
                new DoctrineOrmMappingsPass(
                    $driver,
                    array("%acme_reusable.$configKey.class%"),
                    array('acme_reusable.model_manager_name', 'orm'),
                    "acme_reusable.use_default.$configKey"
                )
            );
        }
    }
}
