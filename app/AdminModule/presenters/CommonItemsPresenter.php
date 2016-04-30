<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

abstract class CommonItemsPresenter extends BasePresenter
{
	protected $model;


	protected $items;


	protected $selectedItem;


	public function startup()
	{
		parent::startup();

		if (!isset($this->model))
		{
			throw new InvalidStateException('Presenter model has not been set!');
		}
	}


	public function actionDefault()
	{
		$this->items = $this->model->findBy(['user_id' => $this->user->id]);
	}


	public function renderDefault()
	{
		$this->template->items			= $this->items;
		$this->template->isItemSelected	= isset($this->selectedItem);
	}


	public function itemFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->nullEmptyValues($values);

		$values->user_id = $this->user->id;

		if ($values->id)
		{
			$this->model->update($values, $values->id);
		}
		else
		{
			$this->model->insert($values);
		}

		$this->flashMessage('Item has been successfully saved.');

		$this->redirect('this');
	}


	public function handleDeleteItem($itemId)
	{
		$this->model->deleteBy(['user_id' => $this->user->id, 'id' => $itemId]);

		$this->redirect('this');
	}


	public function handleEditItem($itemId)
	{
		if (!$this->isAjax())
		{
			return;
		}

		$this->selectedItem = $this->model->find($itemId);

		$this->redrawControl('editDialog');
	}
}