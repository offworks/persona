<?php
require_once __DIR__.'/vendor/autoload.php';

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

return $app;