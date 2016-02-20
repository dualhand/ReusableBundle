<?php
namespace ReusableBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

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

    public function getSubscribedEvents()
    {
        return [ Events::loadClassMetadata ];
    }

    /**
     * @var ClassMetadataInfo
     */
    protected $classMetadata;

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $this->classMetadata = $eventArgs->getClassMetadata();
        $classMetadata = $this->classMetadata;

        if($classMetadata->reflClass === $this->cartClass){

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