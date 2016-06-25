<?php
namespace App\Middleware;

class ModuleSetup
{
	public function handle($exe)
	{
		$exe->module->on('Web', function($module) use($exe)
		{
			$module['callable']->set('render', function($view, array $data = array()) use($exe)
			{
				$layout = $this->view->create('layout');

				$layout->set('url', $exe->url);

				$view = $this->view->create($view)->set($data);

				$layout->set('view', $view);

				return $layout->render();
			});
		});

		return $exe->next($exe);
	}
}