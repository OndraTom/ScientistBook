<?php

namespace App\AdminModule\Presenters;

use Nette\Utils\ArrayHash;
use App\Components\Navigation;

abstract class BasePresenter extends \App\Presenters\BasePresenter
{
	protected $navigationLeft = [
		'About:default'			=> 'About',
		'Education:default'		=> 'Education',
		'Positions:default'		=> 'Positions',
		'Awards:default'		=> 'Awards',
		'Interests:default'		=> 'Interests',
		'Projects:default'		=> 'Projects',
		'Publications:default'	=> 'Publications',
		'Teaching:default'		=> 'Teaching',
		'Gallery:default'		=> 'Gallery',
	];


	protected $navigationRight = [
		':Front:Homepage:default'	=> 'Homepage',
		'logout!'					=> 'Log-out'
	];


	public function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn())
		{
			$this->flashErrorMessage('Please, log-in before enter the administration.');

			$this->redirect(':Login:default');
		}
	}


	protected function nullEmptyValues(ArrayHash &$values)
	{
		foreach ($values as $key => $value)
		{
			if (!is_array($value))
			{
				if (trim($value) == '')
				{
					$values[$key] = null;
				}
			}
		}
	}
	
	
	protected function createComponentLeftNavigation()
	{
		return new Navigation($this, $this->navigationLeft, 'left-nav');
	}


	protected function createComponentRightNavigation()
	{
		return new Navigation($this, $this->navigationRight, 'right-nav');
	}
}