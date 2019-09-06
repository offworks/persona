<?php

namespace Persona\Controllers\Web;

use Persona\Context;
use Persona\Controllers\BaseController;
use Persona\Entity\User;
use Persona\Exceptions\UserException;

class AuthController extends BaseController
{
    /**
     * @path /login
     */
    public function getLogin(Context $context)
    {
        $user = $context->fluent->table('user')
            ->first();

        return $context->twig->render('web/login.twig', [
            'has_user' => $user ? true : false
        ]);
    }

    /**
     * @path /login
     */
    public function postLogin(Context $context)
    {
        $user = $context->fluent->table('user')
            ->first();

        if (!$user) {
            $user = new User();

            $user->password = password_hash($context->param('password'), PASSWORD_DEFAULT);

            $user->save();
        } else {
            if (!password_verify($context->param('password'), $user->password)) {
                $context->flash->set('error', 'Invalid password');

                return $context->redirect->previous();
            }
        }

        $context->session->set('user_id', $user->id);

        return $context->redirect->route('@admin.blogs.get-list');
    }
}