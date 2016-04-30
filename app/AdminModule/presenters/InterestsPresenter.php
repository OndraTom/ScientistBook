<?php

namespace App\AdminModule\Presenters;

use App\Models\InterestsModel;
use App\Components\DialogForm;

class InterestsPresenter extends CommonItemsPresenter
{
	public function __construct(InterestsModel $interestsModel)
	{
		$this->model = $interestsModel;
	}


	protected function createComponentInterestForm()
	{
		$form = $this->getForm();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		if (isset($this->selectedItem))
		{
			$form->setDefaults($this->selectedItem);
		}

		return new DialogForm($form, 'Edit Interest', isset($this->selectedItem));
	}
}