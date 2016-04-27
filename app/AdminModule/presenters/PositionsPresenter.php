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
				->addRule(Form::RANGE, 'Year has to be between 1900 and ' . date('Y'), array(1900, date('Y')))
				->setRequired();

		$form->addText('year_to', 'Year to:')
				->addCondition(Form::FILLED)
					->addRule(Form::RANGE, 'Year has to be between 1900 and ' . date('Y'), array(1900, date('Y')));

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}