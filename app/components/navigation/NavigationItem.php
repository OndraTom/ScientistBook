<?php

namespace App\Components;

class NavigationItem
{
	protected $link;


	protected $title;


	protected $isSelected;


	public function __construct($link, $title, $isSelected)
	{
		$this->link			= $link;
		$this->title		= $title;
		$this->isSelected	= $isSelected;
	}


	public function getHtml()
	{
		$html = '<div class="nav-item';

		if ($this->isSelected)
		{
			$html .= ' selected';
		}

		$html .= '"><a href="' . $this->link . '">' . $this->title . '</a></div>';

		return $html;
	}
}