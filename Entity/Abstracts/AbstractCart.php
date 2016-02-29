<?php

namespace Acme\ReusableBundle\Entity\Abstracts;

use Doctrine\Common\Collections\Collection;
use Acme\ReusableBundle\Model\Interfaces\CartInterface;
use Acme\ReusableBundle\Model\Interfaces\CartLineInterface;
use Acme\ReusableBundle\Model\Traits\DateTimeTrait;
use Acme\ReusableBundle\Model\Traits\IdentifiableTrait;

/**
 * Class AbstractCart.
 *
 * @author Germán Figna <gfigna@wearemarketing.com>
 */
abstract class AbstractCart implements CartInterface
{
    use IdentifiableTrait,
        DateTimeTrait;

    /**
     * @var Collection
     *
     * Lines
     */
    protected $cartLines;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var int
     *
     * Quantity
     */
    protected $quantity;

    /**
     * @var OrderInterface
     *
     * The associated order entity. It is a one-one
     * relation and can be null on the Cart side
     */
    protected $order;

    /**
     * Set cart lines.
     *
     * @param Collection $cartLines Cart Lines
     *
     * @return AbstractCart Self object
     */
    public function setCartLines(Collection $cartLines)
    {
        $this->cartLines = $cartLines;

        return $this;
    }

    /**
     * Get lines.
     *
     * @return Collection CartLine collection
     */
    public function getCartLines()
    {
        return $this->cartLines;
    }

    /**
     * Add Cart Line.
     *
     * @param CartLineInterface $cartLine Cart line
     *
     * @return AbstractCart Self object
     */
    public function addCartLine(CartLineInterface $cartLine)
    {
        if (!$this->cartLines->contains($cartLine)) {
            $this->cartLines->add($cartLine);
        }

        return $this;
    }

    /**
     * Remove Cart Line.
     *
     * @param CartLineInterface $cartLine Cart line
     *
     * @return AbstractCart Self object
     */
    public function removeCartLine(CartLineInterface $cartLine)
    {
        $this->cartLines->removeElement($cartLine);

        return $this;
    }

    /**
     * Set amount.
     *
     * @param float $amount
     *
     * @return AbstractCart Self object
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount.
     *
     * @return float Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Cart #'.$this->getId();
    }
}
