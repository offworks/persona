<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;
use Persona\Entity\Category;
use Respect\Validation\Exceptions\ExceptionInterface;

/**
 * @name articles
 * @path /blog
 */
class ArticlesController extends BaseController
{
    /**
     * @path /create
     */
    public function getCreate(Context $context)
    {
        $categories = Category::get();

        return $context->twig->render('admin/blog/create.twig', array(
            'categories' => $categories->pluck('name', 'id')->toArray(),
            'flash' => $context->flash
        ));
    }

    /**
     * @path /create
     */
    public function postCreate(Context $context)
    {
        $validator = \v::attribute('title', \v::notEmpty())->attribute('body', \v::notEmpty());

        try
        {
            $validator->assert((object) $context->params());

            $article = new \Persona\Entity\Article;
            $article->user_id = $context->user->id;
            $article->title = $context->param('title');
            $article->slug = str_slug($article->title);
            $article->published_at = $context->param('published_at');
            $article->category_id = $context->param('category_id', 0);
            $article->body = $context->param('body');
            $article->save();
        }
        catch(ExceptionInterface $e)
        {
            $context->flash->set('errors', $e->getMessages());

            return $context->redirect->previous();
        }

        $context->flash->set('message', 'New article added!');

        return $context->redirect->route('@admin.articles.get-list');
    }

    public function groupArticle()
    {
        return ArticleController::class;
    }

    /**
     * @path /:page?
     */
    public function getList(Context $context)
    {
        $page = $context->param('page');

        $limit = 5;

        $query = \Persona\Entity\Article::where('user_id', $context->user->id)
            ->orderBy('id', 'desc');

        $total = $query->count();

        $articles = $query->forPage($page, $limit)->get();

        return $context->twig->render('admin/blog/index.twig', array(
            'articles' => $articles,
            'paginator' => new \JasonGrimes\Paginator($total, $limit, $page, $context->url->route('get-list', ['page' => '(:num)']))
        ));
    }
}