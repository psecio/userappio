<?php
namespace Psecio\Userappio;

abstract class Base
{
	private $service;

	public function setService(\Psecio\Userappio\Service $service)
	{
		$this->service = $service;
	}
	public function getService()
	{
		return $this->service;
	}
}