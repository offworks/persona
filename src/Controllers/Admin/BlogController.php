<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;
use Persona\Entity\Article;
use Respect\Validation\Exceptions\ExceptionInterface;

/**
 * Class BlogController
 * @package Persona\Controllers\Admin
 *
 * @path /:article-id
 */
class BlogController extends BaseController
{
    public function middleware(Context $context)
    {
        $article = Article::where('id', $context->param('article-id'))
            ->first();

        return $context->next($context, $article);
    }

    /**
     * @path /update
     * @param Context $context
     * @param Article|\stdClass $article
     * @return string
     */
    public function getUpdate(Context $context, $article)
    {
        $form = $context->form;

        $form->set('title', $article->title);
        $form->set('body', $article->body);
        $form->set('category_id', $article->category_id);
        $form->set('published_at', $article->published_at);

        return $context->twig->render('admin/blog/update.twig', array(
            'article' => $article,
            'categories' => \Persona\Entity\Category::get()->pluck('name', 'id')->toArray(),
            'flash' => $context->flash
        ));
    }

    /**
     * @path /update
     */
    public function postUpdate(Context $context, Article $article)
    {
        $article->title = $context->param('title');

        if(!$article->slug)
            $article->slug = str_slug($article->title);

        $article->body = $context->param('body');
        $article->category_id = $context->param('category_id');
        $article->updated_at = \Carbon\Carbon::now();
        $article->save();

        $context->flash->set('message', 'Article updated.');

        return $context->redirect->previous();
    }

    /**
     * @path /delete
     * @param Context $context
     * @param Article $article
     * @return \Exedra\Http\Response
     */
    public function getDelete(Context $context, $article)
    {
        $article->delete();

        $context->flash->set('message', 'Article successfully deleted.');

        return $context->redirect->previous();
    }
}