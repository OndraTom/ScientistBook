<?php

namespace App\FrontModule\Presenters;

use App\Models;
use App\Components\Navigation;

class ProfilePresenter extends BasePresenter
{
	protected $usersModel;
	
	
	protected $scientist;
	
	
	protected $navigationItems = [
		'Profile:default'		=> 'About me',
		'Profile:research'		=> 'Research',
		'Profile:publications'	=> 'Publications',
		'Profile:teaching'		=> 'Teaching',
		'Profile:gallery'		=> 'Gallery',
		'Profile:contact'		=> 'Contact'
	];
	
	
	public function __construct(
		Models\UsersModel $usersModel
	)
	{
		$this->usersModel = $usersModel;
	}
	
	
	protected function loadUser($userId)
	{
		$this->scientist = $this->usersModel->find($userId);
		
		if (!$this->scientist)
		{
			$this->flashErrorMessage('Selected scientist profile does not exist.');
			
			$this->redirect('Homepage:default');
		}
		
		$this->template->scientist		= $this->scientist;
		$this->template->gravatarLink	= $this->usersModel->getGravatarLink($this->scientist);
	}
	
	
	protected function getNavItemsParams()
	{
		$itemsParams = [];
		
		foreach ($this->navigationItems as $page => $title)
		{
			$itemsParams[$page] = ['userId' => $this->scientist->id];
		}
		
		return $itemsParams;
	}
	
	
	public function createComponentNavigation()
	{
		return new Navigation($this, $this->navigationItems, null, $this->getNavItemsParams());
	}
	
	
	public function actionDefault($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function actionResearch($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function actionPublications($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function actionTeaching($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function actionGallery($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function actionContact($userId)
	{
		$this->loadUser($userId);
	}
}