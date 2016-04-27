<?php

namespace App\AdminModule\Presenters;

use App\Models\PublicationsModel;
use Nette\Application\UI\Form;

class PublicationsPresenter extends CommonItemsPresenter
{
	public function __construct(PublicationsModel $publicationsModel)
	{
		$this->model = $publicationsModel;
	}


	protected function createComponentPublicationForm()
	{
		$form = new Form;

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
				->setRequired();

		$form->addText('link', 'Link:');

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = $this->itemFormSubmitted;

		return $form;
	}
}