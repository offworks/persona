<?php return function($backend)
{
	$backend->middleware(function($exe)
	{
		return $exe->next($exe);
	});

	$backend['default']->any('/[:controller]/[*:action]')->execute(function($exe)
	{
		
	});
};