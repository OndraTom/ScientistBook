<?php

namespace App\Models;

use Nette\Security;
use Nette\Database\Table\ActiveRow;
use Nette\Utils\ArrayHash;

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
		list($email, $password) = $credentials;

		$user = $this->findBy([
			'email'		=> $email,
			'password'	=> $this->getCryptetString($password)
		])->fetch();

		if (!$user)
		{
			throw new Security\AuthenticationException('Invalid login or password.');
		}

		return new Security\Identity($user->id, null, $user);
	}
	
	
	public function registrate(ArrayHash $values)
	{
		$values->password = $this->getCryptetString($values->password);
		
		return (bool) $this->insert($values);
	}
	
	
	public function findScientists($string)
	{
		$scientists = [];
		
		$selections = [
			$this->getAll()->where('CONCAT(name, " ", surname) LIKE ?', '%' . $string . '%'),
			$this->getAll()->where('email LIKE ?', $string)
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
		else if ($user->email)
		{
			$email = $user->email;
		}

		return self::GRAVATAR_URL . md5($email) . self::GRAVATAR_URL_PARAMS;
	}
	
	
	public function isEmailFree($email)
	{
		return $this->getAll()->where(['email' => $email])->count() == 0;
	}
	
	
	public function isEmailFreeForUser($userId, $email)
	{
		return $this->getAll()->where('email = ? AND user_id <> ?', $email, $userId)->count() == 0;
	}
}