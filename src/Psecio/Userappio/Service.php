<?php

namespace Psecio\Userappio;

use Psr\Log\LoggerInterface;

class Service
{
	private $appId;
	private $apiToken;
	private $version = 'v1';
	private $client;
	private $endpoint = 'https://api.userapp.io';
	private $userToken;

    /**
     * @var LoggerInterface
     */
    private $logger;

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
	public function getUserToken()
	{
		return $this->userToken;
	}
	public function setUserToken($token)
	{
		$this->userToken = $token;
	}
	public function clearUserToken()
	{
		$this->setUserToken(null);
	}

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
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

	public function send($action, $data = array())
	{
		$client = $this->getClient();
		$client->setBaseUrl($this->endpoint);

		$url = '/'.$this->version.'/'.$action;
		$apiToken = ($this->getUserToken() !== null) 
			? $this->getUserToken() : $this->getApiToken();

        if ($this->logger) {
            $this->logger->info('token is: '.$apiToken." (".$action.")");
        }

		$request = $client->post($url, null, $data)
			->setAuth($this->getAppId(), $apiToken);
		$response = $request->send();

		return json_decode($response->getBody());
	}
}