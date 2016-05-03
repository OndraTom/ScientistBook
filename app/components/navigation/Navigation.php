<?php

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Presenter;

class Navigation extends Control
{
	protected $modules = [
		'Admin',
		'Front'
	];


	protected $navItems;


	protected $presenter;
	
	
	protected $currentLink;
	
	
	protected $navId;


	public function __construct(Presenter $presenter, array $navItems, $navId = null, $params = [])
	{
		$this->presenter	= $presenter;
		$this->currentLink	= $this->getSanitizedLink($presenter->getName() . ':' . $presenter->getAction());
		$this->navItems		= $this->getNavigation($navItems, $params);
		$this->navId		= $navId;
	}
	
	
	protected function getSanitizedLink($link)
	{
		if (strpos($link, ':') === 0)
		{
			$link = substr($link, 1);
		}

		foreach ($this->modules as $module)
		{
			$link = str_replace($module . ':', '', $link);
		}
		
		return $link;
	}


	protected function getNavigation(array $links, array $linksParams = [])
	{
		$nav = [];

		foreach ($links as $link => $title)
		{
			$itemParams = isset($linksParams[$link]) ? $linksParams[$link] : [];
			
			$nav[] = new NavigationItem($this->presenter->link($link, $itemParams), $title, $this->getSanitizedLink($link) == $this->currentLink);
		}

		return $nav;
	}


	public function render()
	{
		$template			= $this->template;
		$template->navItems	= $this->navItems;
		$template->navId	= $this->navId;

		$template->render(__DIR__ . '/navigation.latte');
	}
}