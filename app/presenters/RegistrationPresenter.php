<?php

namespace App\Presenters;

use Nette\Application\UI\Form;
use App\Renderers\PrettyFormRenderer;
use Nette\Utils\ArrayHash;
use App\Models\UsersModel;

class RegistrationPresenter extends BasePresenter
{
	protected $usersModel;
	
	
	public function __construct(UsersModel $usersModel)
	{
		$this->usersModel = $usersModel;
	}

	
	protected function createComponentSignupForm()
	{
		$form = new Form;
		
		$form->setRenderer(new PrettyFormRenderer);
		
		$form->addText('email', 'E-mail:')
				->addRule(Form::EMAIL);
		
		$form->addText('name', 'Name:')
				->setRequired();
		
		$form->addText('surname', 'Surname:')
				->setRequired();
		
		$form->addPassword('password', 'Password:')
				->setRequired()
				->addRule(Form::MIN_LENGTH, 'Password need at least 6 characters.', 6);
		
		$form->addPassword('passwordConfirm', 'Confirm Password:')
				->setRequired()
				->addRule(Form::EQUAL, 'Passwords aren\'t equal.', $form['password'])
				->setOmitted();
		
		$form->onValidate[] = $this->validateRegistrationForm;
		$form->onSuccess[]	= $this->registrationFormSubmitted;
		
		$form->addSubmit('signup', 'Sign-up');
		
		return $form;
	}
	
	
	public function validateRegistrationForm(Form $form)
	{
		$values = $form->getValues();
		
		if (!$this->usersModel->isEmailFree($values->email))
		{
			$form->addError('This e-mail is already used.');
		}
	}
	
	
	public function registrationFormSubmitted(Form $form, ArrayHash $values)
	{
		if ($this->usersModel->registrate($values))
		{
			$this->flashMessage('You\'ve been successfully signed up. You can log-in now.');

			$this->redirect('Login:default');
		}
		else
		{
			$this->flashErrorMessage('Registration failed.');
			
			$this->redirect('this');
		}
	}
}