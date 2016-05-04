<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;
use App\Renderers\PrettyFormRenderer;
use App\Components\Navigation;

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
	
	
	protected $rightNavItems = [
		':Registration:default' => 'Sign-up',
		'Login:default'			=> 'Log-in'
	];


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

		$this->redirect(':Front:Homepage:default');
	}


	protected function getForm()
	{
		$form = new Form;

		$form->setRenderer(new PrettyFormRenderer);

		return $form;
	}
	
	
	protected function createComponentRightNav()
	{
		return new Navigation($this, $this->rightNavItems, 'right-nav');
	}
}