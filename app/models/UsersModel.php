<?php

namespace App\Models;

use Nette\Security;
use Nette\Database\Table\ActiveRow;

/**
 * Users model.
 *
 * @author Ondrej Tom
 */
class UsersModel extends BaseModel implements Security\IAuthenticator
{
	const GRAVATAR_URL			= 'http://www.gravatar.com/avatar/';
	const GRAVATAR_URL_PARAMS	= '?d=mm&s=140';
	
	
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
	
	
	public function findScientists($string)
	{
		$scientists = [];
		
		$selections = [
			$this->getAll()->where('CONCAT(name, " ", surname) LIKE ?', '%' . $string . '%'),
			$this->getAll()->where('mail LIKE ?', $string)
		];
		
		foreach ($selections as $selection)
		{
			foreach ($selection as $user)
			{
				$scientists[] = $user;
			}
		}
		
		return $scientists;
	}
	
	
	public function getGravatarLink(ActiveRow $user)
	{
		$email = '';

		if ($user->gravatar_email)
		{
			$email = $user->gravatar_email;
		}
		else if ($user->mail)
		{
			$email = $user->mail;
		}

		return self::GRAVATAR_URL . md5($email) . self::GRAVATAR_URL_PARAMS;
	}
}