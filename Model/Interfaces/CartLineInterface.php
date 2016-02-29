<?php

namespace Acme\ReusableBundle\Model\Interfaces;

/**
 * Class CartLineInterface.
 *
 * @author Germán Figna <gfigna@wearemarketing.com>
 */
interface CartLineInterface
{
    /**
     * @param $cart
     *
     * @return CartLineInterface Self object
     */
    public function setCart(CartInterface $cart);

    /**
     * @return CartInterface
     */
    public function getCart();

    /**
     * @param $purchasable
     *
     * @return CartLineInterface Self object
     */
    public function setPurchasable(PurchasableInterface $purchasable);

    /**
     * @return PurchasableInterface
     */
    public function getPurchasable();

    /**
     * @param $quantity
     *
     * @return CartLineInterface Self object
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();
}
