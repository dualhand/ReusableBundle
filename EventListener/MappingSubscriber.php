<?php

namespace Acme\ReusableBundle\EventListener;

use Acme\ReusableBundle\DependencyInjection\Configuration;
use Acme\ReusableBundle\Entity\AbstractPurchasable;
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
     * @var array
     */
    protected $purchasableMap;

    /**
     * @param string $cartClass
     * @param string $cartLineClass
     * @param array  $purchasableMap
     */
    public function __construct($cartClass, $cartLineClass, array $purchasableMap)
    {
        $this->cartClass = $cartClass;
        $this->cartLineClass = $cartLineClass;
        $this->purchasableMap = $purchasableMap;
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

        if ($classMetadata->reflClass === AbstractPurchasable::class) {
            $classMetadata->setDiscriminatorMap($this->purchasableMap);
        }
    }
}
