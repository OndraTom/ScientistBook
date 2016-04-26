<?php

namespace App\AdminModule\Presenters;

use App\Models\AwardsModel;
use Nette\Application\UI\Form;

class AwardsPresenter extends CommonItemsPresenter
{
	public function __construct(AwardsModel $awardsModel)
	{
		$this->model = $awardsModel;
	}


	protected function createComponentAwardForm()
	{
		$form = new Form;

		$form->addText('year', 'Year:')
				->setRequired();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addTextArea('description', 'Description:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}