<?php
return function($api)
{
	$api->middleware(function($exe)
	{
		// every other request other than GET must be authenticated.
		if(!$exe->request->isMethod('GET'))
		{
			
		}

		try
		{
			$response = $exe->next($exe);
		}
		catch(\Exception $e)
		{
			if($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
				$error = 'Record does not exists';

			return json_encode(array(
				'error' => array(
					'code' => 404,
					'message' => $error
					)));
		}

		$response = array('data' => $response->toArray());

		return json_encode($response);
	});

	$api->any('/articles')->group(function($articles)
	{
		$articles->get('/')->execute(function()
		{
			return \Persona\Entity\Article::all();
		});

		$articles->post('/')->execute(function()
		{

		});

		$articles->any('/[:id]')->group(function($article)
		{
			$article->middleware(function($exe)
			{
				$article = \Persona\Entity\Article::findOrFail($exe->param('id'));

				return $exe->next($exe, $article);
			});

			$article->get('/')->execute(function($exe, $article)
			{
				return $article;
			});
		});
	});
};