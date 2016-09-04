<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(array(
	'namespace' => 'Persona',
	'path.root' => __DIR__
	));

if($app->path->has('config/env.php'))
{
	$config = $app->path->load('config/env.php');

	foreach($config as $key => $value)
		$app->config->set($key, $value);
}

$app->path['routes'] = 'routes';

$app->provider->add(\Laraquent\Support\Exedra\Provider::class);

$app->map->middleware(\Persona\Middleware\Components::class);

$app->map['web']->module('Web')->group('web.php');

$app->map['api']->any('/api')->module('Api')->group('api.php');

$app->map['admin']->module('Admin')->group('admin.php');

return $app;