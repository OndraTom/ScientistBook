<?php

namespace App\AdminModule\Presenters;

use App\Models\PublicationsModel;
use Nette\Application\UI\Form;
use App\Components\DialogForm;

class PublicationsPresenter extends CommonItemsPresenter
{
	public function __construct(PublicationsModel $publicationsModel)
	{
		$this->model = $publicationsModel;
	}


	protected function createComponentPublicationForm()
	{
		$form = $this->getForm();

		$form->addSelect('type_id', 'Publication type:', $this->model->getPublicationTypesList())
				->setRequired();

		$form->addText('title', 'Title:')
				->setRequired();

		$form->addText('co_authors', 'Co-authors:')
				->setRequired();

		$form->addText('paper_name', 'Paper title:')
				->setRequired();

		$form->addTextArea('abstract', 'Abstract:')
				->setRequired();

		$form->addText('year', 'Year:')
				->addRule(Form::RANGE, 'Year has to be between 1900 and ' . date('Y'), array(1900, date('Y')))
				->setRequired();

		$form->addText('link', 'Link:');

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		if (isset($this->selectedItem))
		{
			$form->setDefaults($this->selectedItem);
		}

		return new DialogForm($form, 'Edit Publication', isset($this->selectedItem));
	}
}