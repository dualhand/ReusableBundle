<?php

namespace DualHand\ReusableBundle;

use DualHand\ReusableBundle\DependencyInjection\DualHandReusableExtension;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DualHandReusableBundle.
 */
class DualHandReusableBundle extends Bundle
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
     * @return DualHandReusableExtension
     */
    public function getContainerExtension()
    {
        return new DualHandReusableExtension();
    }

    /**
     * @param ContainerBuilder $container
     */
    private function buildOrmCompilerPass(ContainerBuilder $container)
    {
        $arguments = array(
            array(
                realpath(__DIR__.'/Resources/config/doctrine-model') => 'DualHand\ReusableBundle\Model',
            ),
            '.orm.xml',
        );

        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\XmlDriver', array($locator));

        foreach ($this->getContainerExtension()->getEntitiesOverrides() as $configKey => $entity) {
            $container->addCompilerPass(
                new DoctrineOrmMappingsPass(
                    $driver,
                    array("%DualHand_reusable.$configKey.class%"),
                    array('DualHand_reusable.model_manager_name'),
                    "DualHand_reusable.use_default.$configKey"
                )
            );
        }
    }
}
