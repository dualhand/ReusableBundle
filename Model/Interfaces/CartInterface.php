<?php

namespace Acme\ReusableBundle\Model\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * Interface CartInterface.
 */
interface CartInterface
{
    /**
     * @return Collection
     */
    public function getCartLines();

    /**
     * @param Collection $cartLines
     *
     * @return CartInterface
     */
    public function setCartLines(Collection $cartLines);

    /**
     * @param CartLineInterface $cartLine
     *
     * @return CartInterface
     */
    public function addCartLine(CartLineInterface $cartLine);

    /**
     * @param CartLineInterface $cartLine
     *
     * @return CartInterface
     */
    public function removeCartLine(CartLineInterface $cartLine);

    /**
     * Gets amount with tax.
     *
     * @return float price with tax
     */
    public function getAmount();

    /**
     * Sets amount with tax.
     *
     * @param float $amount price with tax
     *
     * @return CartInterface Self object
     */
    public function setAmount($amount);

    /**
     * Sets the number of items on this cart.
     *
     * @param int $quantity Quantity
     *
     * @return CartInterface Self object
     */
    public function setQuantity($quantity);

    /**
     * Gets the number of items on this cart.
     *
     * @return int Quantity
     */
    public function getQuantity();
}
