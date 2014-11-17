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


    /**
     * @param $method
     */
    protected function setMethodSend($method)
    {
        $this->methodSend = "/$method";
    }

    /**
     * @return mixed
     */
    protected function getMethodSend()
    {
        return $this->methodSend;
    }

    /**
     * @param $url
     */
    protected function setResourceUrl($url)
    {
        $this->resourceUrl = $url;
    }

    /**
     * @return mixed
     */
    protected function getResourceUrl()
    {
        return $this->resourceUrl;
    }

    /**
     * @param $token
     */
    protected function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    protected function getToken()
    {
        return $this->token;
    }

    /**
     * @param $data
     */
    protected function setDataSend($data)
    {
            $this->dataSend = $data;
    }

    /**
     * @return mixed
     */
    protected function getDataSend()
    {
        return $this->dataSend;
    }

    /**
     * @param $data
     */
    protected function setReturnData($data)
    {
        $this->returnData = $data;
    }

    /**
     * @return mixed
     */
    protected function getReturnData()
    {
        return $this->returnData;
    }

    /**
     * @param $data
     * @return string
     * @throws RocketException
     */
    protected function makeJson($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        } else {
            throw new RocketException("Please provide a array data");
        }
    }

    /**
     * @param $json
     * @return array
     */
    protected function jsonArray($json)
    {
        return json_decode($json);
    }

    /**
     *  Prepare the SDK
     */
    protected function prepareSDKCheckout()
    {
        $this->setResourceUrl('http://ewallet.rocketpays.com');
    }

    /**
     *  Prepare the SDK
     */
    protected function prepareSDKSandboxCheckout()
    {
        $this->setResourceUrl('http://ewallet.sandbox.rocketpays.com');
    }

    /**
     *  Prepare the SDK
     */
    protected function prepareSDKDeveloperCheckout()
    {
        $this->setResourceUrl('http://ewallet.rocketpays.dev');
    }

    /**
     * @param $to
     * @return bool
     */
    protected function sendRequest($to)
    {
        return true;

    }

    /**
     * @return bool
     */
    protected function curlSend($debug = false)
    {

        $curl = curl_init($this->getResourceUrl() . $this->getMethodSend());

        $datasend = $this->getDataSend();

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

        if($debug)
            die($curl_response);


        $this->setReturnData($curl_response);

        return true;
    }

}
