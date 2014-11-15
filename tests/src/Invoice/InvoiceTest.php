<?php
/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-11-14 at 19:48:29.
 */
class InvoiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Invoice
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Rocket\Invoice\Invoice();
    }

    public function testInvoice()
    {

        $this->assertInstanceOf("\Rocket\Invoice\Invoice", $this->object);

    }

    public function testBasicInvoice()
    {

        $invoice = $this->putInvoice();

        $this->assertNotEmpty($invoice->getCancelUrl());
        $this->assertNotEmpty($invoice->getCustomerEmail());
        $this->assertNotEmpty($invoice->getCustomerName());
        $this->assertNotEmpty($invoice->getInvoiceCurrency());
        $this->assertNotEmpty($invoice->getInvoiceDescription());
        $this->assertNotEmpty($invoice->getInvoiceNumber());
        $this->assertNotEmpty($invoice->getInvoiceDeliveryFee());
        $this->assertNotEmpty($invoice->getInvoiceDiscounts());
        $this->assertNotEmpty($invoice->getSuccessUrl());
        $this->assertNotEmpty($invoice->getInvoiceProducts());

        $products = $invoice->getInvoiceProducts();

        foreach ($products as $product) {

            $this->assertInstanceOf("\Rocket\Invoice\InvoiceProduct",$product);

            $this->assertNotEmpty($product->getName());
            $this->assertNotEmpty($product->getDescription());
            $this->assertNotEmpty($product->getQuantity());
            $this->assertNotEmpty($product->getUnityPrice());


        }


    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called afterst is executed.
     */
    protected function tearDown()
    {

    }

    protected function putInvoice()
    {
        $invoice = new \Rocket\Invoice\Invoice();
        $invoice->setCancelUrl("http://www.example.net");
        $invoice->setSuccessUrl("http://www.example.net");
        $invoice->setCustomerEmail("test@teste.com.br");
        $invoice->setCustomerName("teste");
        $invoice->setInvoiceCurrency('USD');
        $invoice->setInvoiceDeliveryFee("0.00");
        $invoice->setInvoiceDiscounts("0.00");
        $invoice->setInvoiceNumber("0099203");
        $invoice->setInvoiceDescription("Teste");

        $product = new \Rocket\Invoice\InvoiceProduct();
        $product->setDescription("teste");
        $product->setName("teste");
        $product->setQuantity("10");
        $product->setUnityPrice("10");

        $invoice->addProducts($product);

        return $invoice;
    }
}
