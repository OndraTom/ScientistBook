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


	protected $leftNav;


	protected $rightNav;


	protected $presenter;


	public function __construct(Presenter $presenter, array $leftItems, array $rightItems)
	{
		$this->presenter	= $presenter;
		$this->leftNav		= $this->getNavigation($leftItems);
		$this->rightNav		= $this->getNavigation($rightItems);
	}


	protected function getNavigation(array $links)
	{
		$nav = [];

		$presenter = $this->getPresenterFromLink($this->presenter->getName());

		foreach ($links as $link => $title)
		{
			$nav[] = new NavigationItem($this->presenter->link($link), $title, $this->getPresenterFromLink($link) == $presenter);
		}

		return $nav;
	}


	protected function getPresenterFromLink($link)
	{
		if (strpos($link, ':') === 0)
		{
			$link = substr($link, 1);
		}

		foreach ($this->modules as $module)
		{
			$link = str_replace($module . ':', '', $link);
		}

		$parts = explode(':', $link);

		return array_shift($parts);
	}


	public function render()
	{
		$template			= $this->template;
		$template->leftNav	= $this->leftNav;
		$template->rightNav	= $this->rightNav;

		$template->render(__DIR__ . '/navigation.latte');
	}
}