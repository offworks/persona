<?php
namespace Persona\Admin\Controller;

class Base
{
	public function __construct($exe)
	{
		$this->exe = $exe;

		$this->user = \Persona\Entity\User::find($this->exe->session->get('user_id'));
	}

	public function render($view, array $data = array())
	{
		$this->exe->view->setDefaultData(array(
			'url' => $this->exe->url,
			'form' => $this->exe->form
			));

		$view = $this->exe->view->create($view)->set($data)->prepare();

		if($this->exe->request->isAjax())
			return $view->render();

		$layout = $this->exe->view->create('layout');

		$layout->set('user', $this->user);

		$layout->set('exe', $this->exe);

		$layout->set('view', $view);

		return $layout->render();
	}
}