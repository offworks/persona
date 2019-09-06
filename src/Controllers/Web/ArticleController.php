<?php

namespace Persona\Controllers\Web;

use Persona\Context;
use Persona\Controllers\BaseController;

class ArticleController extends BaseController
{
    /**
     * @name all
     * @path /all
     */
    public function getList()
    {

    }

    /**
     * @name view
     * @path /:slug
     */
    public function getView(Context $context)
    {
        $article = \Persona\Entity\Article::where('slug', $context->param('slug'))->first();

        return $context->twig->render('web/article/view.twig', array(
            'article' => $article
        ));
    }
}