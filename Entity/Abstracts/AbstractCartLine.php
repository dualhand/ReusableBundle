<?php

namespace Acme\ReusableBundle\Entity\Abstracts;

use Acme\ReusableBundle\Model\Interfaces\CartInterface;
use Acme\ReusableBundle\Model\Interfaces\CartLineInterface;
use Acme\ReusableBundle\Model\Interfaces\PurchasableInterface;

/**
 * Class AbstractCartLine.
 */
abstract class AbstractCartLine implements CartLineInterface
{
    /**
     * @var CartInterface
     */
    protected $cart;

    /**
     * @var PurchasableInterface
     */
    protected $purchasable;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var float
     *
     * Total amount
     */
    protected $amount;

    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPurchasable()
    {
        return $this->purchasable;
    }

    /**
     * {@inheritdoc}
     */
    public function setPurchasable(PurchasableInterface $purchasable)
    {
        $this->purchasable = $purchasable;

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
    public function __toString()
    {
        return "{$this->getQuantity()}x {$this->getPurchasable()->getTitle()}";
    }
}
