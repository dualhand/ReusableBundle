<?php

namespace Acme\ReusableBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Class MappingSubscriber.
 */
class MappingSubscriber
{
    /**
     * @var string
     */
    protected $cartClass;

    /**
     * @var string
     */
    protected $cartLineClass;

    /**
     * @param string $cartClass
     * @param string $cartLineClass
     */
    public function __construct($cartClass, $cartLineClass)
    {
        $this->cartClass = $cartClass;
        $this->cartLineClass = $cartLineClass;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadataInfo $classMetadata */
        $classMetadata = $eventArgs->getClassMetadata();

        if ($classMetadata->reflClass === $this->cartClass) {
            $classMetadata->mapOneToMany(array(

                'fieldName' => 'cartLines',
                'targetEntity' => $this->cartLineClass,
                'cascade' => array(
                    1 => 'all',
                ),
                'mappedBy' => 'cart',
                'orphanRemoval' => true,

            ));
        }
    }
}
