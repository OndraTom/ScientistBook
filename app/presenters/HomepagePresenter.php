<?php

namespace App\Presenters;

class HomepagePresenter extends BasePresenter
{
	public function startup() 
	{
		parent::startup();
		
		$this->redirect(':Front:Homepage:default');
	}
}