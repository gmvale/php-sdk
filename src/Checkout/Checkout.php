<?php
namespace Rocket\Checkout;

use Rocket\Core\Functions;
use Rocket\Core\RocketException;

class Checkout extends Functions
{

	public $invoiceToken;
	public $payInvoiceUrl;
	public $clientPass;
	public $invoiceStatus;

	/**
	 * @param $token
	 * @param bool $sandbox
	 */

	public function __construct($token,$sandbox = false,$developer=false)
	{
		$this->setToken($token);
		$this->prepareSDKCheckout();

		if($sandbox)
			$this->prepareSDKSandboxCheckout();
		if($developer)
			$this->prepareSDKDeveloperCheckout();

	}

	public function createInvoice(\Rocket\Invoice\Invoice $invoice)
	{
		if($invoice instanceof \Rocket\Invoice\Invoice){

			$this->setDataSend($this->makeJson(get_object_vars($invoice)));
			$this->setMethodSend("put-invoice/".$this->getToken());
			$this->curlSend();


			$retorno = $this->jsonArray($this->getReturnData());

			if(!$retorno->success)
				throw new RocketException($retorno->message);


			$this->invoiceToken = $retorno->invoiceCode;

			$this->payInvoiceUrl = $retorno->returnUrl;

			$this->clientPass = false;

			$this->invoiceStatus = $retorno->invoiceStatus;

			if($retorno->user->new)
				$this->clientPass = $retorno->user->userPassword;

			return $retorno;

		}else{
			throw new RocketException("Invalid Invoice Data");
		}

	}

	public function ckeckInvoice($invoice)
	{

	}

	/**
	 * @return mixed
	 */
	public function getInvoiceToken()
	{
		return $this->invoiceToken;
	}

	/**
	 * @param mixed $invoiceToken
	 */
	public function setInvoiceToken($invoiceToken)
	{
		$this->invoiceToken = $invoiceToken;
	}

	/**
	 * @return mixed
	 */
	public function getPayInvoiceUrl()
	{
		return $this->payInvoiceUrl;
	}

	/**
	 * @param mixed $payInvoiceUrl
	 */
	public function setPayInvoiceUrl($payInvoiceUrl)
	{
		$this->payInvoiceUrl = $payInvoiceUrl;
	}

	/**
	 * @return mixed
	 */
	public function getClientPass()
	{
		return $this->clientPass;
	}

	/**
	 * @param mixed $clientPass
	 */
	public function setClientPass($clientPass)
	{
		$this->clientPass = $clientPass;
	}

	/**
	 * @return mixed
	 */
	public function getInvoiceStatus()
	{
		return $this->invoiceStatus;
	}

	/**
	 * @param mixed $invoiceStatus
	 */
	public function setInvoiceStatus($invoiceStatus)
	{
		$this->invoiceStatus = $invoiceStatus;
	}



	public function redirectUser()
	{
		$redirect = $this->getPayInvoiceUrl();

		header("location:$redirect");
	}


	
}