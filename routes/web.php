<?php return function($web)
{
	$web->middleware(function($exe)
	{
		$module = $exe->module['Web'];

		return $exe->next($exe, $exe->module['Web']);
	});

	$web['index']->get('/')->execute('controller=Web@index');

	$web['about']->get('/about-me');

	$web['articles']->any('/articles')->group(function($articles)
	{
		$articles['article']->get('/[:article-slug]')->execute(function($exe, $module)
		{

		});
	});
};