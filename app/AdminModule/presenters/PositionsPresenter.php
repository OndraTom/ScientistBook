<?php

namespace App\AdminModule\Presenters;

use App\Models\PositionsModel;
use Nette\Application\UI\Form;

class PositionsPresenter extends CommonItemsPresenter
{
	public function __construct(PositionsModel $positionsModel)
	{
		$this->model = $positionsModel;
	}


	protected function createComponentPositionForm()
	{
		$form = new Form;

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addText('place', 'Place:')
				->setRequired();

		$form->addText('year_from', 'Year from:')
				->setRequired();

		$form->addText('year_to', 'Year to:');

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}