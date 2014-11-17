<?php

use Rocket\Checkout\Checkout;

/**
 * CheckoutTest
 *
 * Put the description Here
 * PHP version 5.5
 *
 * @category   SDK
 * @package    ${NAMESPACE}
 * @subpackage CheckoutTest
 * @version    1.0.0
 * @author     Daniel Chaves <daniel@danielchaves.com.br>
 * @link       http://www.danielchaves.com.br
 */
class CheckoutTest extends PHPUnit_Framework_TestCase
{



    public function testInvalidConstructor()
    {
        $this->setExpectedException('Rocket\Core\RocketException');

        $checkout = new Checkout(false);
    }



    /**
     * @covers            \Rocket\Checkout\Checkout::__construct
     */
    public function testValidContructor()
    {
        $checkout = new \Rocket\Checkout\Checkout("TestToken");
        $this->assertInstanceOf('\Rocket\Checkout\Checkout', $checkout);
    }


    public function testSandBox()
    {
        $checkout = new Checkout('ttste',true);


        $this->assertEquals("http://ewallet.sandbox.rocketpays.com", PHPUnit_Framework_Assert::readAttribute($checkout, 'resourceUrl'));
    }

    public function testDeveloperMode()
    {
        $checkout = new Checkout('ttste','',true);

        $this->assertEquals("http://ewallet.rocketpays.dev", PHPUnit_Framework_Assert::readAttribute($checkout, 'resourceUrl'));
    }


    public function testNewInvoice()
    {
        $checkout = new Checkout("QzNBNjkyRkNFOUJFNTRBMTdCNTBDOTRGRjE4ODAwRjFDNkY0QTE3QQ==",'',true);

        $this->assertEquals("http://ewallet.rocketpays.dev", PHPUnit_Framework_Assert::readAttribute($checkout, 'resourceUrl'));

        $this->assertInstanceOf("Rocket\Invoice\Invoice", $this->putInvoice());

        $this->assertInstanceOf("Rocket\Checkout\Checkout", $checkout);

        $checkout = new Checkout("QzNBNjkyRkNFOUJFNTRBMTdCNTBDOTRGRjE4ODAwRjFDNkY0QTE3QQ==",true);
        $checkout->createInvoice($this->putInvoice());

        $this->assertNotEmpty(PHPUnit_Framework_Assert::readAttribute($checkout, 'token'));

        $this->assertNotEmpty(PHPUnit_Framework_Assert::readAttribute($checkout, 'token'));

        $this->assertNotEmpty($this->invokePrivateMethod($checkout,"getMethodSend"));

        $this->assertNotEmpty($checkout->getInvoiceToken());
        $this->assertNotEmpty($checkout->getPayInvoiceUrl());
        $this->assertEmpty($checkout->getClientPass());
        $this->assertNotEmpty($checkout->getInvoiceStatus());

        $this->assertTrue($this->invokePrivateMethod($checkout,"sendRequest", array("me")));



    }

    public function testQueryInvoice()
    {

        $checkout = new Checkout("QzNBNjkyRkNFOUJFNTRBMTdCNTBDOTRGRjE4ODAwRjFDNkY0QTE3QQ==", FALSE, TRUE);
        $dados = $checkout->ckeckInvoice("ff520c91fd6f01d5ba757cb9b71dc58c"); //Invoice Unique Id
        $status = $checkout->getInvoiceStatus();

        $this->assertNotEmpty($status);

        $this->assertNotEmpty($dados);



    }

    public function testQueryInvoiceError()
    {

        $this->setExpectedException('Rocket\Core\RocketException');

        $checkout = new Checkout("QzNBNjkyRkNFOUJFNTRBMTdCNTBDOTRGRjE4ODAwRjFDNkY0QTE3QQ==", false, true);
        $checkout->ckeckInvoice("88129721893712937"); //Invoice Unique Id

    }


    public function testExcetionNewInvoice()
    {
        $this->setExpectedException('Rocket\Core\RocketException');

        $checkout = new Checkout("Invalid Token",true);
        $invoice = $this->putInvoice();
        $checkout->createInvoice($invoice);
        $this->assertNotEmpty(PHPUnit_Framework_Assert::readAttribute($checkout, 'token'));

        $this->assert($this->invokePrivateMethod($checkout,"getMethodSend"));

    }

    public function testExcetionNewInvoiceData()
    {
        $this->setExpectedException('Rocket\Core\RocketException');

        $checkout = new Checkout("Invalid Token",true);
        $invoice =array("Nothing");
        $checkout->createInvoice($invoice);


    }


    public function testJson()
    {
        $checkout = new Checkout("Invalid Token",true);
        $this->assertJson($this->invokePrivateMethod($checkout,"makeJson", array(array("success" => true))));
    }

    public function testErrorJson()
    {
        $this->setExpectedException('Rocket\Core\RocketException');
        $checkout = new Checkout("Invalid Token",true);
        $this->assertJson($this->invokePrivateMethod($checkout,"makeJson",array("D")));
    }


    protected function putInvoice()
    {
        $invoice = new \Rocket\Invoice\Invoice();
        $invoice->setCancelUrl("http://www.example.net");
        $invoice->setSuccessUrl("http://www.example.net");
        $invoice->setCustomerEmail("info@rocketpays.com");
        $invoice->setCustomerName("Test Invoice");
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




    public function invokePrivateMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }




}