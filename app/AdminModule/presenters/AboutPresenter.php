<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use App\Models\UsersModel;
use Nette\Utils\ArrayHash;

class AboutPresenter extends BasePresenter
{
	protected $usersModel;


	protected $bio;


	public function __construct(UsersModel $usersModel)
	{
		$this->usersModel = $usersModel;
	}


	public function actionDefault()
	{
		$this->bio = $this->usersModel->find($this->user->id)->bio;
	}


	protected function createComponentAboutForm()
	{
		$form = new Form;

		$form->addTextArea('bio', 'Bio:')
				->setDefaultValue($this->bio)
				->setRequired('Please, fill the Bio.');

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->aboutFormSubmitted;

		return $form;
	}


	public function aboutFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->usersModel->update($values, $this->user->id);

		$this->flashMessage('Bio has been successfully saved.');

		$this->redirect('this');
	}
}