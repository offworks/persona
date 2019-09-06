<?php

namespace Persona\Controllers;

use Persona\Context;
use Persona\Controllers\Web\ArticleController;
use Persona\Controllers\Web\AuthController;
use Persona\Entity\Article;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Class WebController
 * @package Persona\Controllers
 *
 * @path /
 */
class WebController extends BaseController
{
    /**
     * @path /
     */
    public function getIndex(Context $context)
    {
        $articles = Article::take(1)->orderBy('id', 'desc')->get();

        $latest = Article::take(3)->orderBy('id', 'desc')->get();

        return $context->twig->render('web/index.twig', [
            'articles' => $articles,
            'latest' => $latest,
            'user' => \Persona\Entity\User::first()
        ]);
    }

    /**
     * @path /article/:slug
     */
    public function getArticle(Context $context)
    {
        $article = \Persona\Entity\Article::where('slug', $context->param('slug'))->first();

        return $context->twig->render('web/article.twig', [
            'article' => $article
        ]);
    }

    /**
     * @name auth
     * @path /auth
     */
    public function groupAuth()
    {
        return AuthController::class;
    }

    /**
     * @path /a
     */
    public function groupArticle()
    {
        return ArticleController::class;
    }
}
