<?php
namespace Persona\Admin\Controller;

class Dashboard extends Base
{
	public function getIndex()
	{
		return $this->render('dashboard/index', array(
			'articles' => \Persona\Entity\Article::take(5)->get()
			));
	}

	public function getLogout()
	{
		$this->exe->session->destroy('user_id');

		return $this->exe->redirect->route('@web.index');
	}
}