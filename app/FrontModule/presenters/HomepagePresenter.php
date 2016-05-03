<?php

namespace App\FrontModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use App\Models\UsersModel;

class HomepagePresenter extends BasePresenter
{
	protected $usersModel;
	
	
	protected $foundUsers;
	
	
	public function __construct(UsersModel $usersModel) 
	{
		$this->usersModel = $usersModel;
	}
	
	
	public function actionDefault($scientist = '')
	{
		if ($scientist)
		{
			$this->foundUsers = $this->usersModel->findScientists($scientist);
		}
	}
	
	
	public function renderDefault()
	{
		$this->template->foundUsers = $this->foundUsers;
	}
	
	
	protected function createComponentFindScientistForm()
	{
		$form = new Form;
		
		$form->setMethod('get');
		
		$form->addText('scientist')
				->setRequired();
		
		$form->addSubmit('find', 'Find');
		
		$form->onSuccess[] = $this->findScientistFormSubmitted;
		
		return $form;
	}
	
	
	public function findScientistFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->redirect('Homepage:default', array('scientist' => $values->scientist));
	}
}