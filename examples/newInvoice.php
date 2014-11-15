<?php

require_once (__DIR__  . '/../src/autoload.php');


$checkout = new \Rocket\Checkout\Checkout("NjQ1MzVDNUE2M0Y0QUI0NzU4NTQwMEFGNkU1QUZGQTdDMTZDOTJFNw==",false,true);

$invoice = new \Rocket\Invoice\Invoice();
$invoice->setCancelUrl("http://www.example.net/cancel");
$invoice->setSuccessUrl("http://www.example.net/success");
$invoice->setCustomerEmail("info@rocketpays.com");
$invoice->setCustomerName("Test Invoice User");
$invoice->setInvoiceCurrency('USD');
$invoice->setInvoiceDeliveryFee("0.00");
$invoice->setInvoiceDiscounts("0.00");
$invoice->setInvoiceNumber("0099203");
$invoice->setInvoiceDescription("Test Invoice Description");

$product = new \Rocket\Invoice\InvoiceProduct();
$product->setDescription("Test Purposes");
$product->setName("Test Product");
$product->setQuantity("10");
$product->setUnityPrice("1.00");

$invoice->addProducts($product);

$checkout->createInvoice($invoice);

$invoiceId = $checkout->getInvoiceToken(); // UNIQUE ID FOR YOUR INVOICE
$invoicePayURL = $checkout->getPayInvoiceUrl(); // URL TO SEND YOUR CUSTOMER TO PAY






