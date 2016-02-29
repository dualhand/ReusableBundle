<?php

namespace Acme\ReusableBundle\Entity\Abstracts;

use Acme\ReusableBundle\Model\Interfaces\PurchasableInterface;
use Acme\ReusableBundle\Model\Traits\IdentifiableTrait;

/**
 * @author Germán Figna <gfigna@wearemarketing.com>
 */
abstract class AbstractPurchasable implements PurchasableInterface
{
    use IdentifiableTrait;

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
     * Gets product SKU.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Sets product SKU.
     *
     * @param string $sku
     *
     * @return $this Self object
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return PurchasableInterface
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set price.
     *
     * @param float $amount Price
     *
     * @return $this Self object
     */
    public function setPrice($amount)
    {
        $this->price = $amount;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float Price
     */
    public function getPrice()
    {
        return $this->price;
    }
}
