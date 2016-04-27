<?php

namespace App\AdminModule\Presenters;

use App\Models\GalleryModel;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Exception;

class GalleryPresenter extends CommonItemsPresenter
{
	public function __construct(GalleryModel $galleryModel)
	{
		$this->model = $galleryModel;
	}


	protected function createComponentPhotosForm()
	{
		$form = new Form;

		$form->addMultiUpload('photos', 'Photos')
				->setRequired();

		$form->addSubmit('save', 'Upload');

		$form->onSuccess[] = $this->photosFormSubmitted;

		return $form;
	}


	public function photosFormSubmitted(Form $form, ArrayHash $values)
	{
		try
		{
			$this->model->uploadPhotos($this->user->id, $values->photos);

			$this->flashMessage('Photos have been sucessfully uploaded.');
		}
		catch (Exception $e)
		{
			$this->flashErrorMessage($e->getMessage());
		}

		$this->redirect('this');
	}


	public function handleDeletePhoto($photoId)
	{
		try
		{
			$this->model->deletePhoto($this->user->id, $photoId);
		}
		catch (Exception $e)
		{
			$this->flashErrorMessage($e->getMessage());
		}

		$this->redirect('this');
	}
}