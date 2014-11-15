<?php

namespace Rocket\Invoice;

use Rocket\Core\RocketException;

class Invoice
{

    public $invoiceNumber;
    public $invoiceDescription;
    public $invoiceCurrency = 'USD';
    public $customerName;
    public $customerEmail;
    public $invoiceDiscounts = 0.00;
    public $invoiceDeliveryFee = 0.00;
    public $successUrl;
    public $cancelUrl;
    public $invoiceProducts = array();

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param mixed $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return mixed
     */
    public function getInvoiceDescription()
    {
        return $this->invoiceDescription;
    }

    /**
     * @param mixed $invoiceDescription
     */
    public function setInvoiceDescription($invoiceDescription)
    {
        $this->invoiceDescription = $invoiceDescription;
    }

    /**
     * @return string
     */
    public function getInvoiceCurrency()
    {
        return $this->invoiceCurrency;
    }

    /**
     * @param string $invoiceCurrency
     */
    public function setInvoiceCurrency($invoiceCurrency)
    {
        $this->invoiceCurrency = $invoiceCurrency;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param mixed $customerEmail
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return mixed
     */
    public function getInvoiceDiscounts()
    {
        return $this->invoiceDiscounts;
    }

    /**
     * @param mixed $invoiceDiscounts
     */
    public function setInvoiceDiscounts($invoiceDiscounts)
    {
        $this->invoiceDiscounts = $invoiceDiscounts;
    }

    /**
     * @return mixed
     */
    public function getInvoiceDeliveryFee()
    {
        return $this->invoiceDeliveryFee;
    }

    /**
     * @param mixed $invoiceDeliveryFee
     */
    public function setInvoiceDeliveryFee($invoiceDeliveryFee)
    {
        $this->invoiceDeliveryFee = $invoiceDeliveryFee;
    }

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param mixed $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param mixed $cancelUrl
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
    }

    /**
     * @return array
     */
    public function getInvoiceProducts()
    {
        return $this->invoiceProducts;
    }

    /**
     * @param array $invoiceProducts
     */
    public function setInvoiceProducts($invoiceProducts)
    {
        $this->invoiceProducts = $invoiceProducts;
    }

    /**
     * Add a Product to the invoice
     * @param  InvoiceProduct  $product
     * @return bool
     * @throws RocketException
     */
    public function addProducts(InvoiceProduct $product)
    {

        if(!$product instanceof InvoiceProduct)
            throw new RocketException("Invalid Product Class");

        $products = $this->getInvoiceProducts();

        $newProducts = array_merge($products,array($product));

        $this->setInvoiceProducts($newProducts);

        return true;

    }

}
