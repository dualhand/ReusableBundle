<?php

namespace Acme\ReusableBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Acme\ReusableBundle\Entity\Interfaces\CartInterface;
use Acme\ReusableBundle\Entity\Interfaces\CartLineInterface;

/**
 * Class AbstractCart.
 */
abstract class AbstractCart implements CartInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $cartLines;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var int
     */
    protected $quantity;

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
     * @return AbstractCart
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
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
     * @return Collection CartLine collection
     */
    public function getCartLines()
    {
        return $this->cartLines;
    }

    /**
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
