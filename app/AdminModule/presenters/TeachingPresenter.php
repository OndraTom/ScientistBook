<?php

namespace App\AdminModule\Presenters;

use App\Models\TeachingModel;
use Nette\Application\UI\Form;

class TeachingPresenter extends CommonItemsPresenter
{
	public function __construct(TeachingModel $teachingModel)
	{
		$this->model = $teachingModel;
	}


	protected function createComponentTeachingForm()
	{
		$form = new Form;

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addTextArea('description', 'Description:')
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