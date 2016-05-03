<?php

namespace App\FrontModule\Presenters;

use App\Models;
use App\Components\Navigation;

class ProfilePresenter extends BasePresenter
{
	protected $usersModel;
	
	
	protected $positionsModel;
	
	
	protected $educationModel;
	
	
	protected $awardsModel;
	
	
	protected $interestsModel;
	
	
	protected $projectsModel;
	
	
	protected $publicationsModel;
	
	
	protected $teachingModel;
	
	
	protected $galleryModel;
	
	
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
		Models\UsersModel			$usersModel,
		Models\PositionsModel		$positionsModel,
		Models\EducationModel		$educationModel,
		Models\AwardsModel			$awardsModel,
		Models\InterestsModel		$interestsModel,
		Models\ProjectsModel		$projectsModel,
		Models\PublicationsModel	$publicationsModel,
		Models\TeachingModel		$teachingModel,
		Models\GalleryModel			$galleryModel
	)
	{
		$this->usersModel			= $usersModel;
		$this->positionsModel		= $positionsModel;
		$this->educationModel		= $educationModel;
		$this->awardsModel			= $awardsModel;
		$this->interestsModel		= $interestsModel;
		$this->projectsModel		= $projectsModel;
		$this->publicationsModel	= $publicationsModel;
		$this->teachingModel		= $teachingModel;
		$this->galleryModel			= $galleryModel;
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
	
	
	public function renderDefault()
	{
		$this->template->positions	= $this->positionsModel->findBy(['user_id' => $this->scientist->id])->order('year_from DESC');
		$this->template->educations = $this->educationModel->findBy(['user_id' => $this->scientist->id]);
		$this->template->awards		= $this->awardsModel->findBy(['user_id' => $this->scientist->id]);
	}
	
	
	public function actionResearch($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function renderResearch($userId)
	{
		$this->template->interests	= $this->interestsModel->findBy(['user_id' => $this->scientist->id]);
		$this->template->projects	= $this->projectsModel->findBy(['user_id' => $this->scientist->id]);
	}
	
	
	public function actionPublications($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function renderPublications()
	{
		$this->template->publications = $this->publicationsModel->findBy(['user_id' => $this->scientist->id])->order('year DESC');
	}
	
	
	public function actionTeaching($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function renderTeaching()
	{
		$this->template->teachings = $this->teachingModel->findBy(['user_id' => $this->scientist->id]);
	}
	
	
	public function actionGallery($userId)
	{
		$this->loadUser($userId);
	}
	
	
	public function renderGallery()
	{
		$this->template->photos = $this->galleryModel->findBy(['user_id' => $this->scientist->id]);
	}
	
	
	public function actionContact($userId)
	{
		$this->loadUser($userId);
	}
}