<?php
namespace Psecio\Userappio;

class User extends Base
{
	public function login($username, $password)
	{
		$service = $this->getService();
		$result = $service->send(
			'user.login',
			array('login' => $username, 'password' => $password)
		);
		// set the user token
		$service->setUserToken($result->token);
		$this->setService($service);

		return $result;
	}

	public function save($data)
	{
		return $this->getService()->send('user.save', $data);
	}

	public function logout()
	{
		$service = $this->getService();
		$result = $this->getService()->send('user.logout');

		// clear out the user token
		$service->clearUserToken();
		$this->setService($service);

		return $result;
	}
}