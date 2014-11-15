<?php

namespace Rocket\Invoice;

class InvoiceProduct
{

    public $name = '';
    public $description = '';
    public $unityPrice = 0.00;
    public $quantity = 0.00;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getUnityPrice()
    {
        return $this->unityPrice;
    }

    /**
     * @param float $unityPrice
     */
    public function setUnityPrice($unityPrice)
    {
        $this->unityPrice = $unityPrice;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}
