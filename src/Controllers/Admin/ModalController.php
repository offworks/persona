<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;
use Respect\Validation\Exceptions\ExceptionInterface;

/**
 * @path /modals
 */
class ModalController extends BaseController
{
    /**
     * @name get-create-category
     * @path /category/create
     * @return string
     */
    public function getCreateCategory(Context $context)
    {
        return $context->twig->render('admin/modals/create-category.twig');
    }

    /**
     * @name post-create-category
     * @path /category/create
     */
    public function postCreateCategory(Context $context)
    {
        $validator = \v::attribute('name', \v::notEmpty());
        $params = $context->params();

        try
        {
            $validator->assert((object) $params);

            // insert.
            $category = new \Persona\Entity\Category;
            $category->name = $params['name'];
            $category->created_by = $context->user->id;
            $category->save();

            $context->flash->set('message', 'Successfully added ['.$category.'] category.');
        } catch(ExceptionInterface $e) {
            $context->flash->set('errors', $e->getMessages());
        }

        return $context->redirect->previous();
    }
}