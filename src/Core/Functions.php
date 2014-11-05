<?php

namespace Rocket\Core;


/**
 * Functions
 *
 * Class for default functions of the SDK
 * PHP version 5.5
 *
 * @category   php-sdk
 * @package    Rocket\Core
 * @subpackage Functions
 * @version    1.0.0
 * @author     Daniel Chaves <daniel@danielchaves.com.br>
 * @link       http://www.rocketpays.com
 */


class Functions
{

	protected $resourceUrl;

	protected $token;

	protected $dataSend;

	protected $returnData;

	protected $methodSend;

	protected function setMethodSend($method)
	{
		$this->methodSend = "/$method";
	}

	protected function getMethodSend()
	{
		return $this->methodSend;
	}

	protected function setResourceUrl($url)
	{
		$this->resourceUrl = $url;
	}

	protected function getResourceUrl()
	{
		return $this->resourceUrl;
	}

	protected function setToken($token)
	{
		$this->token = $token;
	}

	protected function getToken()
	{
		return $this->token;
	}

	protected function setDataSend(array $data)
	{
		if(is_array($data))
			$this->dataSend = $data;
	}

	protected function getDataSend()
	{
		return $this->dataSend;
	}

	protected function setReturnData($data)
	{
		$this->returnData = $data;
	}

	protected function getReturnData()
	{
		return $this->returnData;
	}

	protected function makeJson(array $data)
	{
		if(is_array($data)){
			return json_encode($data);
		}else{
			throw new RocketException("Please provide a array data");
		}
	}

	protected function prepareSDK()
	{
		$this->setResourceUrl('http://ewallet.rocketpays.com');
	}

	protected function prepareSDKSandbox()
	{
		$this->setResourceUrl('http://ewallet.sandbox.rocketpays.com');
	}

	protected function prepareSDKDeveloper()
	{
		$this->setResourceUrl('http://ewallet.rocketpays.dev');
	}


	protected function sendRequest($to)
	{

	}


	protected function curlSend()
	{

		$curl = curl_init($this->getResourceUrl() . $this->getMethodSend());
		
		$datasend = '';
		foreach ($this->getDataSend() as $key => $value) {
		    $datasend .= $key.'='.$value.'&';
		}
		rtrim($datasend, '&');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $datasend);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "token: " . $this->getToken(),
        ));
		$curl_response = curl_exec($curl);
		curl_close($curl);

		$this->setReturnData($curl_response);


		return true;
	}

	
}