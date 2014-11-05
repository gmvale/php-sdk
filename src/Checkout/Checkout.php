<?php
namespace Rocket\Checkout;

use Rocket\Core\Functions;
use Rocket\Core\RocketException;

class Checkout extends Functions
{

	public function __construct($token,$sanbox = false,$developer=false)
	{
		$this->setToken(token);
		$this->prepareSDK();

		if($sanbox)
			$this->prepareSDKSandbox();
		if($developer)
			$this->prepareSDKDeveloper();

	}

	public function createInvoice(\Rocket\Invoice\Invoice $invoice)
	{
		if($invoice instanceof \Rocket\Invoice\Invoice){

		}else{
			throw new RocketException("Invalid Ivoice Data");
		}

	}

	public function ckeckInvoice($invoice)
	{

	}
	
}