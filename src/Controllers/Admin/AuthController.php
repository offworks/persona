<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;

/**
 * @path /auth
 */
class AuthController extends BaseController
{
    /**
     * @name logout
     * @path /logout
     */
    public function getLogout(Context $context)
    {
        $context->session->destroy('user_id');

        return $context->redirect->route('@web.get-index');
    }
}