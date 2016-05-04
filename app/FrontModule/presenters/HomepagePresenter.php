<?php

namespace App\FrontModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use App\Models\UsersModel;
use App\Renderers\PrettyFormRenderer;

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
		$httpRequest = $this->context->getByType('Nette\Http\Request');
		
		$form = new Form;
		
		$form->setRenderer(new PrettyFormRenderer);
		
		$form->setMethod('get');
		
		$form->addText('scientist', 'Scientist:')
				->setRequired()
				->setDefaultValue($httpRequest->getQuery('scientist'));
		
		$form->addSubmit('find', 'Find');
		
		$form->onSuccess[] = $this->findScientistFormSubmitted;
		
		return $form;
	}
	
	
	public function findScientistFormSubmitted(Form $form, ArrayHash $values)
	{
		$this->redirect('Homepage:default', array('scientist' => $values->scientist));
	}
}