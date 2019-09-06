<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;

/**
 * Class ProjectsController
 * @name projects
 * @path /projects
 */
class ProjectsController extends BaseController
{
    /**
     * @path /
     */
    public function getIndex(Context $context)
    {
        return $context->twig->render('admin/project/index.twig', array(
            'projects' => \Persona\Entity\Project::get()
        ));
    }

    /**
     * @path /create
     */
    public function getCreate(Context $context)
    {
        return $context->twig->render('admin/project/create.twig');
    }

    /**
     * @path /create
     */
    public function postCreate(Context $context)
    {
        $params = $context->params();

        $validator = \v::attribute('name', \v::notEmpty())
            ->attribute('description', \v::notEmpty());

        try {
            $validator->assert((object) $params);

            $project = new \Persona\Entity\Project;
            $project->name = $params['name'];
            $project->description = $params['description'];
            $project->date_start = $params['date_start'];
            $project->date_end = $params['date_end'];
            $project->save();

            $context->flash->set('message', 'Project ['.$project->name.'] added.');
        } catch(\Respect\Validation\Exceptions\ExceptionInterface $e) {
            $context->flash->set('errors', $e->getMessages());

            return $context->redirect->previous();
        }

        return $context->redirect->route('get-index');
    }

    public function groupProject()
    {
        return ProjectController::class;
    }
}