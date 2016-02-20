<?php

namespace DualHand\ReusableBundle\Entity\Interfaces;

/**
 * Class CartLineInterface.
 */
interface CartLineInterface
{
    /**
     * @param CartInterface $cart
     *
     * @return CartLineInterface Self object
     */
    public function setCart(CartInterface $cart);

    /**
     * @return CartInterface
     */
    public function getCart();

    /**
     * @param PurchasableInterface $purchasable
     *
     * @return CartLineInterface Self object
     */
    public function setPurchasable(PurchasableInterface $purchasable);

    /**
     * @return PurchasableInterface
     */
    public function getPurchasable();

    /**
     * @param int $quantity
     *
     * @return CartLineInterface Self object
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();
}
