<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(array(
	'namespace' => 'Persona',
	'path.root' => __DIR__
	));

$app->config->set('db', array(
	'host' => 'localhost',
	'name' => 'persona',
	'user' => 'root',
	'password' => ''
	));

$app->path['routes'] = 'routes';

$app->provider->add(\Laraquent\Support\Exedra\Provider::class);

$app->map->middleware(\Persona\Middleware\Components::class);

$app->map['web']->module('Web')->group('web.php');

$app->map['api']->any('/api')->module('Api')->group('api.php');

$app->map['admin']->module('Admin')->group('admin.php');

return $app;