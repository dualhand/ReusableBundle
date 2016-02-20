<?php

namespace ReusableBundle\Entity\Abstracts;

use ReusableBundle\Model\Interfaces\CartInterface;
use ReusableBundle\Model\Interfaces\CartLineInterface;
use ReusableBundle\Model\Interfaces\PurchasableInterface;
use ReusableBundle\Model\Traits\IdentifiableTrait;

/**
 * Class AbstractCartLine.
 *
 * @author Germán Figna <gfigna@wearemarketing.com>
 */
abstract class AbstractCartLine implements CartLineInterface
{
    use IdentifiableTrait;

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
     * @inheritDoc
     */
    public function __toString()
    {
        return "{$this->getQuantity()}x {$this->getPurchasable()->getTitle()} {$this->getPurchasableAmount()}";
    }
}
