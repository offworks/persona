<?php return function($web)
{
	$web->handler('controller', function($handler)
	{
		$handler->onValidate(function($pattern)
		{
			if(!is_string($pattern))
				return false;

			if(strpos($pattern, 'controller=') === 0)
				return true;

			return false;
		});

		$handler->onResolve(function($pattern)
		{
			$pattern = str_replace('controller=', '', $pattern);

			return function($exe) use($pattern)
			{
				@list($controller, $action) = explode('@', $pattern);

				$action = isset($action) ? $action : 'index';

				return $exe->rest($controller, $action);
			};
		});
	});

	$web->middleware(function($exe)
	{
		return $exe->next($exe);
	});

	$web['login']->method('GET|POST', '/login')->execute('controller=Web@login');

	$web['index']->get('/')->execute('controller=Web@index');

	$web['about']->get('/about-me');

	$web->get('/[:category]')->execute('controller=Article@byCategory');

	$web['articles']->any('/a')->group(function($articles)
	{
		$articles['index']->get('/')->execute('controller=Article@index');

		$articles['article']->get('/[:slug]')->execute('controller=Article@view');
	});
};