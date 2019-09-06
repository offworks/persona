<?php

namespace Persona\Controllers;

use Persona\Context;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class RootController extends BaseController
{
    /**
     * Handle unhandled exceptions
     */
    public function middlewareWhoops(Context $context)
    {
        $env = $context->config->get('env', 'dev');

        $handlers = [
            'pretty' => PrettyPageHandler::class,
            'json' => JsonResponseHandler::class
        ];

        $handler = $handlers[$context->attr('error-handler', 'pretty')];

        $whoops = new Run();
        $whoops->prependHandler(new $handler());
        $whoops->register();

        try {
            return $context->next($context);
        } catch(\Exception $e) {
            if ($env != 'prod')
                $whoops->handleException($e);
        }
    }

    public function middlewareMergeParams(Context $context)
    {
        $context->addParams($context->request->getParams());

        return $context->next($context);
    }

    public function middlewareTwig(Context $context)
    {
        $context->twig->addGlobal('context', $context);
        $context->twig->addGlobal('form', $context->form);
        $context->twig->addGlobal('url', $context->app->url);

        return $context->next($context);
    }

    public function groupWeb()
    {
        return WebController::class;
    }

    public function groupAdmin()
    {
        return AdminController::class;
    }
}