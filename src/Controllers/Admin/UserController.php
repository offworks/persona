<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;

/**
 * @path /user
 */
class UserController extends BaseController
{
    /**
     * @path /
     */
    public function get(Context $context)
    {
        $form = $context->form;

        $form->set('name', $context->user->name);
        $form->set('email', $context->user->email);
        $form->set('about', $context->user->about);

        return $context->twig->render('admin/user/profile.twig', array(
            'user' => $context->user
        ));
    }

    /**
     * @path /
     */
    public function post(Context $context)
    {
        $params = $context->params();

        $user = $context->user;

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->about = $params['about'];
        $user->save();

        $context->flash->set('message', 'User settings updated.');

        return $context->redirect->previous();
    }

    /**
     * @path /password
     */
    public function getPassword(Context $context)
    {
        return $context->twig->render('admin/user/password.twig');
    }

    /**
     * @path /password
     */
    public function postPassword(Context $context)
    {
        $context->user->password = password_hash($context->param('password'), PASSWORD_DEFAULT);
        $context->user->save();

        $context->flash->set('message', 'Password has been changed.');

        return $context->redirect->route('get');
    }
}