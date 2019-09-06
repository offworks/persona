<?php

namespace Persona\Controllers;

use Persona\Context;
use Persona\Controllers\Admin\ApisController;
use Persona\Controllers\Admin\AuthController;
use Persona\Controllers\Admin\BlogsController;
use Persona\Controllers\Admin\DashboardController;
use Persona\Controllers\Admin\ModalController;
use Persona\Controllers\Admin\ProjectsController;
use Persona\Controllers\Admin\SettingsController;
use Persona\Controllers\Admin\UserController;
use Persona\Entity\User;

/**
 * Class AdminController
 * @package Persona\Controllers
 *
 * @path /admin
 */
class AdminController extends BaseController
{
    public function middleware(Context $context)
    {
        if (!$context->session->has('user_id'))
            throw new \Exception('User is not logged in.');

        $context->set('user', function() use ($context) {
            return User::where('id', $context->session->get('user_id'))
                ->first();
        });

        class_alias('Respect\Validation\Validator', 'v');

        return $context->next($context);
    }

    public function groupBlogs()
    {
        return BlogsController::class;
    }

    public function groupDashboard()
    {
        return DashboardController::class;
    }

    public function groupUser()
    {
        return UserController::class;
    }

    public function groupProjects()
    {
        return ProjectsController::class;
    }

    public function groupSettings()
    {
        return SettingsController::class;
    }

    public function groupModal()
    {
        return ModalController::class;
    }

    public function groupAuth()
    {
        return AuthController::class;
    }

    public function groupApis()
    {
        return ApisController::class;
    }
}