<?php

namespace Acme\ReusableBundle\Entity\Abstracts;

use Acme\ReusableBundle\Model\Interfaces\ProductInterface;
use Acme\ReusableBundle\Model\Traits\DateTimeTrait;

/**
 * Class AbstractProduct.
 *
 * @author Germán Figna <gfigna@wearemarketing.com>
 */
abstract class AbstractProduct extends AbstractPurchasable implements ProductInterface
{
    use DateTimeTrait;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return AbstractProduct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Product #'.$this->getId();
    }
}
