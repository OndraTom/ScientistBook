<?php

namespace App\AdminModule\Presenters;

use App\Models\EducationModel;
use Nette\Application\UI\Form;

class EducationPresenter extends CommonItemsPresenter
{
	public function __construct(EducationModel $educationModel)
	{
		$this->model = $educationModel;
	}


	protected function createComponentEducationForm()
	{
		$form = $this->getForm();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addText('full_title', 'Full title:')
				->setRequired();

		$form->addText('graduation_year', 'Graduation year:')
				->addRule(Form::RANGE, 'Year has to be between 1900 and ' . date('Y'), array(1900, date('Y')))
				->setRequired();

		$form->addText('place', 'Place:')
				->setRequired();

		$form->addHidden('id');

		$form->addSubmit('save', 'Save');

		if (isset($this->selectedItem))
		{
			$form->setDefaults($this->selectedItem);
		}

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}