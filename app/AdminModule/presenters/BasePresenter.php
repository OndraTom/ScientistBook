<?php

namespace App\AdminModule\Presenters;

abstract class BasePresenter extends \App\Presenters\BasePresenter
{
	public function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn())
		{
			$this->flashErrorMessage('Please, log-in before enter the administration.');

			$this->redirect(':Login:default');
		}
	}
}