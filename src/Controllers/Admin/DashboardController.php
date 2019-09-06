<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;

/**
 * Class DashboardController
 * @package Persona\Controllers\Admin
 *
 * @path /dashboard
 */
class DashboardController extends BaseController
{
    public function getIndex(Context $context)
    {
        return $context->twig->render('admin/dashboard/index.twig', array(
            'articles' => $context->fluent('article')->take(5)->get()
        ));
    }
}