<?php

namespace Persona\Providers;

use Exedra\Application;
use Exedra\Contracts\Provider\Provider;
use Laraquent\Factory;

class LaraquentProvider implements Provider
{
    public function register(Application $app)
    {
        $capsule = Factory::boot([
            'host' => 'localhost',
            'name' => $app->config->get('db.name'),
            'user' => $app->config->get('db.user'),
            'pass' => ''
        ]);

        $app->set('@eloquent', function() use ($capsule) {
            return $capsule;
        });

        $app->set('@fluent', function() use ($capsule) {
            return $capsule->getConnection();
        });

        $app->func('@fluent', function ($table) use ($capsule) {
            return $capsule->getConnection()->table($table);
        });
    }
}