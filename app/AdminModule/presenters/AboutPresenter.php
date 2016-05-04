<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use App\Models\UsersModel;
use Nette\Utils\ArrayHash;

class AboutPresenter extends BasePresenter
{
	protected $usersModel;


	protected $userData;


	protected $gravatarLink;


	public function __construct(UsersModel $usersModel)
	{
		$this->usersModel = $usersModel;
	}


	public function startup()
	{
		parent::startup();

		$this->userData		= $this->usersModel->findBy(['id' => $this->user->id])->fetch();
		$this->gravatarLink = $this->usersModel->getGravatarLink($this->userData);
	}


	public function renderDefault()
	{
		$this->template->profilePicLink = $this->gravatarLink;
	}


	protected function createComponentAboutForm()
	{
		$form = $this->getForm();

		$form->getElementPrototype()->class = 'main-center';
		
		$form->addText('email', 'E-mail:')
				->addRule(Form::EMAIL);

		$form->addText('name', 'Name:')
				->setRequired();

		$form->addText('surname', 'Surname:')
				->setRequired();

		$form->addTextArea('bio', 'Bio:')
				->setRequired();

		$form->addText('facility', 'Facility:');

		$form->addTextArea('research_summary', 'Research summary:');

		$form->addTextArea('contact_info', 'Contact info:');

		$form->addText('phone', 'Phone:');

		$form->addText('skype', 'Skype:');

		$form->addText('twitter', 'Twitter:');

		$form->addText('linked_in', 'LinkedIn:');

		$form->addText('gravatar_email', 'Gravatar e-mail:');

		$form->addSubmit('save', 'Save');

		$form->setDefaults($this->userData);

		$form->onValidate[] = $this->validateAboutForm;
		$form->onSuccess[]	= $this->aboutFormSubmitted;

		return $form;
	}
	
	
	public function validateAboutForm(Form $form)
	{
		$values = $form->getValues();
		
		if (!$this->usersModel->isEmailFreeForUser($this->userData->id, $values->email))
		{
			$form->addError('This e-mail is used by another user.');
		}
	}


	public function aboutFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->nullEmptyValues($values);

		$this->usersModel->update($values, $this->user->id);

		$this->flashMessage('Data have been successfully saved.');

		$this->redirect('this');
	}
}