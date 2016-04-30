<?php

namespace App\Presenters;

use Nette\Application\UI\Form;
use	Nette\Security;
use App\Renderers\PrettyFormRenderer;

/**
 *
 *
 * @author Ondrej Tom
 */
class LoginPresenter extends BasePresenter
{
	protected function createComponentLoginForm()
	{
		$form = new Form;

		$form->addText('login', 'Name:')
				->setRequired('Please, write your login name.');

		$form->addPassword('password', 'Password:')
				->setRequired('Please, write your password.');

		$form->addSubmit('signup', 'Sign up');

		$form->onSuccess[] = $this->loginFormSubmitted;

		$form->addProtection();

		$form->setRenderer(new PrettyFormRenderer);

		return $form;
	}


	public function loginFormSubmitted(Form $form, $values)
	{
		try
		{
			$this->getUser()->login($values->login, $values->password);

			$this->flashMessage('You have been successfully signed up.');

			$this->redirect('Homepage:default');
		}
		catch (Security\AuthenticationException $e)
		{
			$this->flashErrorMessage($e->getMessage());

			$this->redirect('this');
		}
	}
}