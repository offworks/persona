<?php
namespace Persona\Web\Controller;

class Web extends Base
{
	public function getIndex()
	{
		$articles = \Persona\Entity\Article::take(1)->orderBy('id', 'desc')->get();

		$latest = \Persona\Entity\Article::take(3)->orderBy('id', 'desc')->get();

		return $this->render('index', array(
			'articles' => $articles,
			'latest' => $latest,
			'user' => \Persona\Entity\User::first()
			));
	}

	public function xgetLogin()
	{
		return $this->render('web/ajax/login');
	}

	public function postLogin(array $params)
	{
		$user = \Persona\Entity\User::first();

		// create initial record.
		if(!$user)
		{
			$user = new \Persona\Entity\User;
			$user->password = password_hash(($pass = bin2hex(openssl_random_pseudo_bytes(3))), PASSWORD_DEFAULT);
			$user->save();

			$this->exe->flash->set('message', 'Password has been created : '.$pass.'. Please change later at your admin settings.');
		}
		else
		{
			if(!password_verify($params['password'], $user->password))
			{
				$this->exe->flash->set('message', 'Wrong password. Sorry.');

				return $this->exe->redirect->previous();
			}

		}

		$this->exe->session->set('user_id', $user->id);

		return $this->exe->redirect->url($this->exe->url->admin('blog', 'index'));
	}
}