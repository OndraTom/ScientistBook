<?php

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class DialogForm extends Control
{
	protected $form;


	protected $header;


	protected $envokeDialog;


	public function __construct(Form $form, $header, $envokeDialog)
	{
		$this->form			= $form;
		$this->header		= $header;
		$this->envokeDialog	= $envokeDialog;
	}


	protected function createComponentEditForm()
	{
		return $this->form;
	}


	public function render()
	{
		$template				= $this->template;
		$template->form			= $this->form;
		$template->header		= $this->header;
		$template->envokeDialog = $this->envokeDialog;

		$template->render(__DIR__ . '/dialogForm.latte');
	}
}