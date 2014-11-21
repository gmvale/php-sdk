<?php
require_once (__DIR__  . '/../src/autoload.php');

use Rocket\Checkout\Checkout;

try {

    $checkout = new Checkout("NjQ1MzVDNUE2M0Y0QUI0NzU4NTQwMEFGNkU1QUZGQTdDMTZDOTJFNw==");
    $dados = $checkout->ckeckInvoice("ff520c91fd6f01d5ba757cb9b71dc58c"); //Invoice Unique Id
    $status = $checkout->getInvoiceStatus();


}catch (\Rocket\Core\RocketException $e){
    echo $e->getMessage();
}

