<?php

namespace Acme\ReusableBundle\Entity\Abstracts;

use Acme\ReusableBundle\Model\Interfaces\ProductInterface;

/**
 * Class AbstractProduct.
 */
abstract class AbstractProduct extends AbstractPurchasable implements ProductInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return AbstractProduct
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return AbstractProduct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Product #'.$this->getId();
    }
}
