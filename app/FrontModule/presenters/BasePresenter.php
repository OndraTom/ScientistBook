<?php

namespace App\FrontModule\Presenters;

use App\Components\Navigation;

abstract class BasePresenter extends \App\Presenters\BasePresenter
{
	protected $loggedNav = [
		'Profile:default'		=> 'My Profile',
		':Admin:About:default'	=> 'Administration',
		'logout!'				=> 'Log-out'
	];
	
	
	protected $unloggedNav = [
		':Registration:default' => 'Sign-up',
		':Login:default'			=> 'Log-in'
	];
	
	
	protected function createComponentLoggedNav()
	{
		return new Navigation($this, $this->loggedNav, 'right-nav', ['Profile:default' => ['userId' => $this->user->id]]);
	}
	
	
	protected function createComponentUnloggedNav()
	{
		return new Navigation($this, $this->unloggedNav, 'right-nav');
	}
}