<?php
/** @var \Persona\App $app */
$app = require_once __DIR__ . '/app.php';

$app->provider->add(\Exedra\Console\ConsoleProvider::class);

$app->console->add(new \Exedra\Routeller\Console\Commands\RouteListCommand($app, $app->map));

$app->console->run();