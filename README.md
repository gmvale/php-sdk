Rocket php-sdk
=================
[![Build Status](https://travis-ci.org/xPayCard/php-sdk.svg)](https://travis-ci.org/xPayCard/php-sdk) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xPayCard/php-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xPayCard/php-sdk/?branch=master) [![Latest Stable Version](https://poser.pugx.org/xpaycard/php-sdk/v/stable.svg)](https://packagist.org/packages/xpaycard/php-sdk) [![Total Downloads](https://poser.pugx.org/xpaycard/php-sdk/downloads.svg)](https://packagist.org/packages/xpaycard/php-sdk) [![Latest Unstable Version](https://poser.pugx.org/xpaycard/php-sdk/v/unstable.svg)](https://packagist.org/packages/xpaycard/php-sdk) [![License](https://poser.pugx.org/xpaycard/php-sdk/license.svg)](https://packagist.org/packages/xpaycard/php-sdk) 

PHP SDK to Rocket API, with this SDK you can create orders and retrivie order status from out checkout

Instalation
-----------

### Main Setup

### Install Composer:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```


#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "xpaycard/php-sdk": "dev-master"
    }
    ```

2. Now tell composer to download xPayCard php-sdk by running the command:

    ```bash
    $ php composer.phar update
    ```
    
3. How to use:

    #### Send a new order:

``` php
<?php

use xPaycard\Core\Order;
use xPaycard\Core\Product;
use xPaycard\Checkou\Checkout;

    $order = new Order();
    $order->setCustomerName('Full Name');
    $order->setCustomerEmail('it@xpaycard.com');
    $order->setOrderNumber('0192003');
    $order->setOrderDescription("Test Sale");
    $order->setOrderCurrency('USD');
    $order->setCancelUrl('http://example.com');
    $order->setDenyUrl('http://example.com');
    $order->setSuccessUrl('http://example.com');
    $order->setOrderDeliveryFee(20);
    $order->setOrderDiscounts(10);

    $product = new Product();
    $product->setName("Test Product");
    $product->setDescription("Test Product Description");
    $product->setUnityPrice(10.00);
    $product->setQuantity(10);
    $order->addProduct($product);

    $product1 = new Product();
    $product1->setName("Test Product");
    $product1->setDescription("Test Product Description");
    $product1->setUnityPrice(10.00);
    $product1->setQuantity(10);
    $order->addProduct($product);

    $Checkout = new Checkout($yourToken); // You can request your token at https://merchant.xpaycard.com
    $Checkout->addOrder($order);
    $Checkout->send();

    $redirectUrl =  $Checkout->getReturnUrl();
    $orderCode =  $Checkout->getOrderCode();
    $responseArray = $Checkout->responseArray();
    
```


#### Query an order:


``` php
<?php

use xPaycard\Core\Order;
use xPaycard\Core\Product;
use xPaycard\Checkou\Checkout;

    

    $Checkout = new Checkout($yourToken); // You can request your token at https://merchant.xpaycard.com
    $queryData = $Checkout->queryOrder($order);


    
```

    


