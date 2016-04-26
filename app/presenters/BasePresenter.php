<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;

/**
 * Ancestor of all presenters.
 *
 * @author Ondrej Tom
 */
abstract class BasePresenter extends Presenter
{
	/**
	 * Flash messages types.
	 */
	const MESSAGE_TYPE_INFO		= 'info';
	const MESSAGE_TYPE_ERROR	= 'error';


	/**
	 * Flash error message.
	 *
	 * @param	string	$text	Message.
	 */
	protected function flashErrorMessage($text)
	{
		$this->flashMessage($text, self::MESSAGE_TYPE_ERROR);
	}


	/**
	 * Handles the logout action.
	 */
	public function handleLogout()
	{
		$this->user->logout(true);

		$this->flashMessage('You have been successfully logged out.');

		$this->redirect(':Login:default');
	}
}