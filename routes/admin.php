<?php return function($backend)
{
	$backend->middleware(function($exe)
	{
		if(!$exe->isLoggedIn())
			return 'Why are u here?';

		class_alias('Respect\Validation\Validator', 'v');
		
		return $exe->next($exe);
	});

	$backend->any('/admin')->execute(function($exe)
	{
		return $exe->forward('default', array(
			'controller' => 'dashboard'
			));
	});

	$backend['default']->any('/admin/[:controller]/[*:action?]')->execute(function($exe)
	{
		$controller = ucfirst($exe->param('controller'));

		return $exe->rest($controller, $exe->param('action', 'index'));
	});
};