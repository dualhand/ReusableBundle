<?php

namespace Acme\ReusableBundle\Model;

use Acme\ReusableBundle\Model\Interfaces\PurchasableInterface;

/**
 * Class AbstractPurchasable.
 */
abstract class AbstractPurchasable implements PurchasableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * Product SKU
     */
    protected $sku;

    /**
     * @var string
     *
     * Product Title
     */
    protected $title;

    /**
     * @var float
     *
     * Product price
     */
    protected $price;

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
     * @return AbstractPurchasable
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($amount)
    {
        $this->price = $amount;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
