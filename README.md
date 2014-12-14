Rocket php-sdk
=================
 
PHP SDK to Rocket API, with this SDK you can create invoices and retrieve invoice status from out Simple Checkout System, you can make API calls when your plan have it.

Instalation
-----------

## Without Composer:
Download this repository and than just include our auto load
``` php
    require_once (__DIR__  . '/../src/autoload.php');
 ```


## Using Composer:


### Install Composer:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

#### After Install:

1. Add this project in your composer.json:

    ```json
    "require": {
        "rocket-system/php-sdk": "dev-master"
    }
    ```

2. Now tell composer to download Rocket php-sdk by running the command:

    ```bash
    $ php composer.phar update
    ```
    
## How to Use:

### Send a new order:

``` php
<?php

use Rocket\Checkout\Checkout;
use Rocket\Invoice\Invoice;
use Rocket\Invoice\InvoiceProduct;

    $checkout = new Checkout("INFORM YOU SIMPLE CHECKOUT KEY");
    
    $invoice = new Invoice();
    $invoice->setInvoiceNumber(0001);
    $invoice->setInvoiceDescription("Test Description");
    $invoice->setCancelUrl("http://example.com/cancel");
    $invoice->setSuccessUrl("http://example.com/success");
    $invoice->setCustomerEmail("john@doe.com");
    $invoice->setCustomerName("John Doe");

    $product = new InvoiceProduct();
    $product->setName("Test Product");
    $product->setDescription("Test Product Description");
    $product->setQuantity(10);
    $product->setUnityPrice(9.90);

    $product2 = new InvoiceProduct();
    $product2->setName("Test Product");
    $product2->setDescription("Test Product Description");
    $product2->setQuantity(1);
    $product2->setUnityPrice(1000.00);

    $invoice->addProducts($product);

    $invoice->addProducts($product2);

    $checkout->createInvoice($invoice);

    $returnUrl = $checkout->getPayInvoiceUrl();
    $invoiceUniqueCode = $checkout->getInvoiceToken();
    $status = $checkout->getInvoiceStatus();
    
```


### Query an order:


``` php
<?php

use Rocket\Checkout\Checkout;

    $checkout = new Checkout("INFORM YOU SIMPLE CHECKOUT KEY");
    $invoice = $checkout->queryInvoice("INVOICE UNIQUE ID");
    $status = $checkout->getInvoiceStatus();
    
```


### Transfer Money:


``` php
<?php

use Rocket\Payment\Transfer;

    $transfer = new Transfer("INFORM YOU SIMPLE CHECKOUT KEY");
    $send = $transfer->sendTransfer("user@email.com",20.00);
    $send->getStatus();
    
```
