<?php

namespace App\Models;

use Nette\Security;

/**
 * Users model.
 *
 * @author Ondrej Tom
 */
class UsersModel extends BaseModel implements Security\IAuthenticator
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $tableName = 'users';


	protected function getCryptetString($string)
	{
		return sha1($string);
	}


	/**
	 * Authenticates user.
	 *
	 * Returns users identity.
	 *
	 * @param	array	$credentials
	 * @return	Security\Identity
	 * @throws	Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($login, $password) = $credentials;

		$user = $this->findBy([
			'login'		=> $login,
			'password'	=> $this->getCryptetString($password)
		])->fetch();

		if (!$user)
		{
			throw new Security\AuthenticationException('Invalid login or password.');
		}

		return new Security\Identity($user->id, null, $user);
	}
}