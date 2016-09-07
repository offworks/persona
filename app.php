<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(array(
	'namespace' => 'Persona',
	'path.root' => __DIR__
	));

$app->autoloadSrc();

if($app->path['app']->has('config/env.php'))
{
	$config = $app->path['app']->load('config/env.php');

	foreach($config as $key => $value)
		$app->config->set($key, $value);
}

$app->provider->add(\Exedra\Support\Provider\Modular::class);

$app->provider->add(\Laraquent\Support\Exedra\Provider::class);

$app->map->middleware(\Persona\Middleware\Components::class);

$app->map['web']->meta('module', 'Web')->group('web.php');

$app->map['api']->any('/api')->meta('module', 'Api')->group('api.php');

$app->map['admin']->meta('module', 'Admin')->group('admin.php');

return $app;