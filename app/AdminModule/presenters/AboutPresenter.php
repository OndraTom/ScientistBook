<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use App\Models\UsersModel;
use Nette\Utils\ArrayHash;

class AboutPresenter extends BasePresenter
{
	protected $usersModel;


	public function __construct(UsersModel $usersModel)
	{
		$this->usersModel = $usersModel;
	}


	protected function createComponentAboutForm()
	{
		$form = new Form;

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

		$form->addSubmit('save', 'Save');

		$form->setDefaults($this->usersModel->findBy(['id' => $this->user->id])->fetch());

		$form->onSuccess[] = $this->aboutFormSubmitted;

		return $form;
	}


	public function aboutFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->usersModel->update($values, $this->user->id);

		$this->flashMessage('Data have been successfully saved.');

		$this->redirect('this');
	}
}