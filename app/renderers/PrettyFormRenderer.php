<?php

namespace App\Renderers;

use Nette\Forms\Rendering\DefaultFormRenderer;

class PrettyFormRenderer extends DefaultFormRenderer
{
	public function __construct()
	{
		$this->wrappers['controls']['container']		= null;
		$this->wrappers['pair']['container']			= 'div class=form-group';
		$this->wrappers['pair']['.error']				= 'has-error';
		$this->wrappers['control']['container']			= null;
		$this->wrappers['label']['container']			= null;
		$this->wrappers['control']['description']		= 'span class=help-block';
		$this->wrappers['control']['errorcontainer']	= 'span class=help-block';
		$this->wrappers['error']['container']			= null;
		$this->wrappers['error']['item']				= 'div class="alert alert-danger"';
	}
}