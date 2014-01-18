<?php
namespace Psecio\Userappio;

class User extends Base
{
	public function login($username, $password)
	{
		return $this->getService()->send(
			'user.login',
			array('login' => $username, 'password' => $password)
		);
	}
}