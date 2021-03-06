<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;
use Persona\Entity\Category;

/**
 * @path /settings
 */
class SettingsController extends BaseController
{
    /**
     * @path /
     */
    public function getIndex(Context $context)
    {
        return $context->twig->render('admin/settings/index.twig', array(
            'categories' => \Persona\Entity\Category::orderBy('name')->get()
        ));
    }

    /**
     * @name category-delete
     * @path /category-delete/:category-id
     */
    public function getCategoryDelete(Context $context)
    {
        /** @var Category $category */
        $category = \Persona\Entity\Category::find($context->param('category-id'));

        $context->flash->set('message', 'Successfully deleted [' . $category . '] category.');

        $category->delete();

        return $context->redirect->previous();
    }

    /*public function getCategoryDelete(Context $context)
    {
        $category = \Persona\Entity\Category::find($params[0]);

        $this->exe->flash->set('message', 'Successfully deleted ['.$category.'] category.');

        $category->delete();

        return $this->exe->redirect->previous();
    }*/

    /*public function xgetCategoryAdd()
    {
        $categories = \Persona\Entity\Category::get();

        return $this->render('settings/category/add', array(
            'categories' => $categories->pluck('id', 'name')
        ));
    }*/

    /*public function postCategoryAdd(array $params)
    {
        $validator = \v::attribute('name', \v::notEmpty());

        try
        {
            $validator->assert((object) $params);

            // insert.
            $category = new \Persona\Entity\Category;
            $category->name = $params['name'];
            $category->created_by = $this->user->id;
            $category->save();

            $this->exe->flash->set('message', 'Successfully added ['.$category.'] category.');
        }
        catch(\Respect\Validation\Exceptions\ExceptionInterface $e)
        {
            $this->exe->flash->set('errors', $e->getMessages());
        }

        return $this->exe->redirect->previous();
    }*/
}