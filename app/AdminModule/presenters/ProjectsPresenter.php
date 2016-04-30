<?php

namespace App\AdminModule\Presenters;

use App\Models\ProjectsModel;
use App\Components\DialogForm;

class ProjectsPresenter extends CommonItemsPresenter
{
	public function __construct(ProjectsModel $projectsModel)
	{
		$this->model = $projectsModel;
	}


	protected function createComponentProjectForm()
	{
		$form = $this->getForm();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addText('short_description', 'Short description:')
				->setRequired();

		$form->addTextArea('description', 'Description:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		if (isset($this->selectedItem))
		{
			$form->setDefaults($this->selectedItem);
		}

		return new DialogForm($form, 'Edit Project', isset($this->selectedItem));
	}
}