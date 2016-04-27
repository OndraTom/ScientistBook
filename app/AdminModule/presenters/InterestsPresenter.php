<?php

namespace App\AdminModule\Presenters;

use App\Models\InterestsModel;
use Nette\Application\UI\Form;

class InterestsPresenter extends CommonItemsPresenter
{
	public function __construct(InterestsModel $interestsModel)
	{
		$this->model = $interestsModel;
	}


	protected function createComponentInterestForm()
	{
		$form = new Form;

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}