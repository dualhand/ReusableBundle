<?php

namespace Acme\ReusableBundle\Traits;

/**
 * Class DeliverableTrait.
 */
trait DeliverableTrait
{
    /**
     * @var float
     */
    protected $weight;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $length;

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     *
     * @return $this Self Object
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return $this Self Object
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     *
     * @return $this Self Object
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     *
     * @return $this Self Object
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }
}
