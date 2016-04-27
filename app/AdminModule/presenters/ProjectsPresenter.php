<?php

namespace App\AdminModule\Presenters;

use App\Models\ProjectsModel;
use Nette\Application\UI\Form;

class ProjectsPresenter extends CommonItemsPresenter
{
	public function __construct(ProjectsModel $projectsModel)
	{
		$this->model = $projectsModel;
	}


	protected function createComponentProjectForm()
	{
		$form = new Form;

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addText('short_description', 'Short description:')
				->setRequired();

		$form->addTextArea('description', 'Description:')
				->setRequired();

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}