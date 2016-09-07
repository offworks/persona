<?php
namespace Persona\Admin\Controller;

class User extends Base
{
	public function getSettings()
	{
		$form = $this->exe->form;

		$form->set('name', $this->user->name);
		$form->set('email', $this->user->email);
		$form->set('about', $this->user->about);

		return $this->render('user/settings', array(
			'user' => $this->user
			));
	}

	public function postSettings(array $params)
	{
		$user = $this->user;

		$user->name = $params['name'];
		$user->email = $params['email'];
		$user->about = $params['about'];
		$user->save();

		$this->exe->flash->set('message', 'User settings updated.');

		return $this->exe->redirect->previous();
	}

	public function getPassword()
	{
		return $this->render('user/password');
	}

	public function postPassword(array $params)
	{
		$this->user->password = password_hash($params['password'], PASSWORD_DEFAULT);
		$this->user->save();

		$this->exe->flash->set('message', 'Password has been changed.');

		return $this->exe->redirect->admin('user', 'settings');
	}
}