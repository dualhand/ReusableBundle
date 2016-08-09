<?php

namespace Acme\ReusableBundle\Model\Interfaces;

/**
 * Interface PurchasableInterface.
 */
interface PurchasableInterface
{
    /**
     * Gets the variant SKU.
     *
     * @return string
     */
    public function getSku();

    /**
     * Sets the variant SKU.
     *
     * @param string $sku
     *
     * @return PurchasableInterface Self object
     */
    public function setSku($sku);

    /**
     * Gets the variant title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets the variant title.
     *
     * @param string $title
     *
     * @return PurchasableInterface Self object
     */
    public function setTitle($title);
}
