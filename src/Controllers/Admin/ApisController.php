<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;

/**
 * Class ApisController
 * @package Persona\Controllers\Admin
 *
 * @path /apis
 */
class ApisController extends BaseController
{
    /**
     * @name markdown-to-html
     * @path /markdown-to-html
     */
    public function postMarkdown(Context $context)
    {
        $parser = new \cebe\markdown\GithubMarkdown();

        // markdown translate.
        $html = $parser->parse($context->param('markdown'));

        return $html;
    }
}