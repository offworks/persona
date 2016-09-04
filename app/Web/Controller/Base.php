<?php
namespace Persona\Web\Controller;

class Base
{
	public function __construct($exe)
	{
		$this->exe = $exe;
	}

	public function render($view, array $data = array())
	{
		$this->exe->view->setDefaultData(array(
			'url' => $this->exe->url,
			'form' => $this->exe->form,
			'exe' => $this->exe
			));

		$view = $this->exe->view->create($view)->set($data)->prepare();

		if($this->exe->request->isAjax())
			return $view->render();

		$layout = $this->exe->view->create('layout');

		// $layout = $this->exe->layout;

		$layout->set('header', $this->exe->view->create('header'));
		
		$layout->set('view', $view);

		return $layout->render();
	}
}