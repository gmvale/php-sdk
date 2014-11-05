<?php

namespace Rocket\Invoice;

class InvoiceProduct
{

    public $name;
    public $description;
    public $unityPrice;
    public $quantity;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUnityPrice()
    {
        return $this->unityPrice;
    }

    /**
     * @param mixed $unityPrice
     */
    public function setUnityPrice($unityPrice)
    {
        $this->unityPrice = $unityPrice;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


	
}