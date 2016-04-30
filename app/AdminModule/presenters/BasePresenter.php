<?php

namespace App\AdminModule\Presenters;

use Nette\Utils\ArrayHash;

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
}