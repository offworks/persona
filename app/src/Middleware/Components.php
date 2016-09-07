<?php
namespace Persona\Middleware;

class Components
{
	public function handle($exe)
	{
		$this->urlRegistry($exe);

		$this->layoutRegistry($exe);

		$this->paramsRegistry($exe);

		$this->restRegistry($exe);

		$exe['callable']->add('isLoggedIn', function()
		{
			return $this->session->has('user_id');
		});

		return $exe->next($exe);
	}

	public function restRegistry($exe)
	{
		$exe['callable']->add('rest', function($controller, $action = 'index', array $params = array())
		{
			$action = strtolower($this->request->getMethod()).ucfirst($action);

			@list($action, $params) = explode('/', $action, 2);

			$params = isset($params) ? explode('/', $params) : array();

			if($this->request->isAjax())
				$action = 'x'.$action;

			$params = array_merge($this->params(), $params);

			return $this->controller->execute([$controller, [$this]], $action, [$params]);
		});
	}

	public function paramsRegistry($exe)
	{
		$exe->addParam($exe->request->getQueryParams());

		if($exe->request->isMethod('POST'))
			$exe->addParam($exe->request->getParsedBody());
	}

	public function urlRegistry($exe)
	{
		$exe->url->callable('admin', function($controller = 'blog', $action = 'index', $params = array())
		{
			$action = count($params) > 0 ? $action . '/' . implode('/', $params) : $action;

			return $this->route('@admin.default', array(
				'controller' => $controller,
				'action' => $action
				));
		});

		$exe->url->callable('web', function($path = '/', array $params = array())
		{
			return $this->base($path);
		});
	}

	public function layoutRegistry($exe)
	{
		$exe['service']->add('layout', function()
		{
			$layout = $this->module['Application']->view->create('layout');

			$layout->set('url', $this->url);

			return $layout;
		});
	}
}