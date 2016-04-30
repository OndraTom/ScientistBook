<?php

namespace App\AdminModule\Presenters;

use App\Models\AwardsModel;
use Nette\Application\UI\Form;
use App\Components\DialogForm;

class AwardsPresenter extends CommonItemsPresenter
{
	public function __construct(AwardsModel $awardsModel)
	{
		$this->model = $awardsModel;
	}


	protected function createComponentAwardForm()
	{
		$form = $this->getForm();

		$form->addText('year', 'Year:')
				->setRequired();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addTextArea('description', 'Description:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		if (isset($this->selectedItem))
		{
			$form->setDefaults($this->selectedItem);
		}

		return new DialogForm($form, 'Edit Award', isset($this->selectedItem));
	}
}