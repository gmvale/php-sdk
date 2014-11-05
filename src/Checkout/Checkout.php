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

			$this->setDataSend($this->makeJson(get_object_vars($invoice)));
			$this->setMethodSend("put-invoice/".$this->getToken());
			$this->curlSend();

			var_dump(($this->getDataSend()));

			var_dump($this->getReturnData());

		}else{
			throw new RocketException("Invalid Invoice Data");
		}

	}

	public function ckeckInvoice($invoice)
	{

	}
	
}