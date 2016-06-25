<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);

$app->config->set('db', array(
	'host' => 'localhost',
	'name' => 'persona',
	'user' => 'root',
	'password' => ''
	));

$app->path['routes'] = 'routes';

$app->path['module'] = 'modules';

$app->provider->add(\Laraquent\Support\Exedra\Provider::class);

$app->map->middleware(\App\Middleware\ModuleSetup::class);

$app->map['web']->module('Web')->group('web.php');

$app->map['admin']->module('Admin')->group('admin.php');

return $app;