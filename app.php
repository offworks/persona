<?php
require_once __DIR__.'/vendor/autoload.php';

//$app = new \Exedra\Application(array(
//	'namespace' => 'Persona',
//	'path.root' => __DIR__
//	));

$app = new \Persona\App(__DIR__, \Persona\Context::class);

if ($app->path->isExists('config/env.json')) {
    foreach (json_decode($app->path->getContents('config/env.json'), true) as $key => $value) {
        $app->config->set($key, $value);
    }
} else {
    throw new \Exception('Missing config/env.json');
}

$app->provider->add(\Exedra\Session\SessionProvider::class);
$app->provider->add(\Exedra\Form\FormProvider::class);
$app->provider->add(\Persona\Providers\TwigProvider::class);
$app->provider->add(\Persona\Providers\LaraquentProvider::class);
$app->provider->add(new \Exedra\Routeller\RoutellerRootProvider(\Persona\Controllers\RootController::class));

//$app->map['web']->group(\Persona\Controllers\WebController::class);
//$app->map['admin']->any('/admin')->group(\Persona\Controllers\AdminController::class);

//if($app->path['app']->has('config/env.php'))
//{
//	$config = $app->path['app']->load('config/env.php');
//
//	foreach($config as $key => $value)
//		$app->config->set($key, $value);
//}

//$app->provider->add(\Exedra\Support\Provider\Modular::class);
//
//$app->provider->add(\Laraquent\Support\Exedra\Provider::class);
//
//$app->map->middleware(\Persona\Middleware\Components::class);
//
//$app->map['web']->meta('module', 'Web')->group('web.php');
//
//$app->map['api']->any('/api')->meta('module', 'Api')->group('api.php');
//
//$app->map['admin']->meta('module', 'Admin')->group('admin.php');

return $app;