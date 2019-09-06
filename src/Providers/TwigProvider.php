<?php

namespace Persona\Providers;

use Exedra\Application;
use Exedra\Contracts\Provider\Provider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;

class TwigProvider implements Provider
{
    public function register(Application $app)
    {
        $app->set('@twig', function () use ($app) {
            $loader = new FilesystemLoader($app->path->to('views'));

            $twig = new Environment($loader);

            $twig->addFilter(new TwigFilter('date_diff', function($date) {
                return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
            }));

            return $twig;
        });
    }
}