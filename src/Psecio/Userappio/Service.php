<?php

namespace Psecio\Userappio;

class Service
{
	private $appId;
	private $apiToken;
	private $version = 'v1';
	private $client;
	private $endpoint = 'https://api.userapp.io';

	public function __construct($appId, $apiToken, $client)
	{
		$this->setApiToken($apiToken);
		$this->setAppId($appId);
		$this->setClient($client);
	}

	public function setAppId($appId)
	{
		$this->appId = $appId;
	}
	public function getAppId()
	{
		return $this->appId;
	}
	public function setApiToken($apiToken)
	{
		$this->apiToken = $apiToken;
	}
	public function getApiToken()
	{
		return $this->apiToken;
	}
	public function getVersion()
	{
		return $this->version;
	}
	public function setVersion($version)
	{
		$this->version = $version;
	}
	public function getClient()
	{
		return $this->client;
	}
	public function setClient($client)
	{
		$this->client = $client;
	}

	public function __get($param)
	{
		$class = '\\Psecio\\Userappio\\'.ucwords($param);
		if (class_exists($class)) {
			$obj = new $class();
			$obj->setService($this);
			return $obj;
		}
	}

	public function send($action, $data)
	{
		$client = $this->getClient();
		$client->setBaseUrl($this->endpoint);
		$url = '/'.$this->version.'/'.$action;

		$request = $client->post($url, null, $data)
			->setAuth($this->getAppId(), $this->getApiToken());
		$response = $request->send();
		return json_decode($response->getBody());
	}
}