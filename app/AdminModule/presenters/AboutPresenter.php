<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use App\Models\UsersModel;
use Nette\Utils\ArrayHash;

class AboutPresenter extends BasePresenter
{
	const GRAVATAR_URL = 'http://www.gravatar.com/avatar/';
	const GRAVATAR_URL_PARAMS = '?d=mm&s=140';


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
		$this->gravatarLink = $this->getGravatarLink();
	}


	public function renderDefault()
	{
		$this->template->profilePicLink = $this->gravatarLink;
	}


	protected function getGravatarLink()
	{
		$email = '';

		if ($this->userData->gravatar_email)
		{
			$email = $this->userData->gravatar_email;
		}
		else if ($this->userData->mail)
		{
			$email = $this->userData->mail;
		}

		return self::GRAVATAR_URL . md5($email) . self::GRAVATAR_URL_PARAMS;
	}


	protected function createComponentAboutForm()
	{
		$form = $this->getForm();

		$form->getElementPrototype()->class = 'main-center';

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

		$form->addText('mail', 'E-mail:')
				->addCondition(Form::FILLED)
					->addRule(Form::EMAIL);

		$form->addText('skype', 'Skype:');

		$form->addText('twitter', 'Twitter:');

		$form->addText('linked_in', 'LinkedIn:');

		$form->addText('gravatar_email', 'Gravatar e-mail:');

		$form->addSubmit('save', 'Save');

		$form->setDefaults($this->userData);

		$form->onSuccess[] = $this->aboutFormSubmitted;

		return $form;
	}


	public function aboutFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->nullEmptyValues($values);

		$this->usersModel->update($values, $this->user->id);

		$this->flashMessage('Data have been successfully saved.');

		$this->redirect('this');
	}
}