<?php

namespace Acme\ReusableBundle\Entity\Interfaces;

/**
 * Interface PurchasableInterface.
 */
interface PurchasableInterface
{
    /**
     * @return float
     */
    public function getPrice();

    /**
     * @param float $price
     *
     * @return PurchasableInterface Self object
     */
    public function setPrice($price);

    /**
     * @return string
     */
    public function getSku();

    /**
     * @param string $sku
     *
     * @return PurchasableInterface Self object
     */
    public function setSku($sku);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     *
     * @return PurchasableInterface Self object
     */
    public function setTitle($title);
}
