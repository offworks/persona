<?php

namespace Persona\Controllers\Admin;

use Persona\Context;
use Persona\Controllers\BaseController;
use Persona\Entity\Project;

/**
 * Class ProjectController
 *
 * @path /:project-id
 */
class ProjectController extends BaseController
{
    public function middleware(Context $context)
    {
        return $context->next($context, Project::find($context->param('project-id')));
    }

    public function getDelete(Context $context, Project $project)
    {
        $context->flash->set('message', 'Successfully deleted project [' . $project->name . ']');

        $project->delete();

        return $context->redirect->previous();
    }

    public function getUpdate(Context $context, Project $project)
    {
        $context->form->set(array(
            'name' => $project->name,
            'description' => $project->description,
            'date_start' => date('Y-m-d', strtotime($project->date_start)),
            'date_end' => date('Y-m-d', strtotime($project->date_end))
        ));

        return $context->twig->render('admin/project/update.twig', array(
            'project' => $project
        ));
    }

    public function postUpdate(array $params)
    {
        $project = \Persona\Entity\Project::find($params[0]);

        $validator = \v::attribute('name', \v::notEmpty())
            ->attribute('description', \v::notEmpty());

        try
        {
            $project->name = $params['name'];
            $project->description = $params['description'];
            $project->date_start = $params['date_start'];
            $project->date_end = $params['date_end'];
            $project->save();

            $this->exe->flash->set('message', 'Project ['.$project->name.'] updated.');
        }
        catch(\Respect\Validation\Exceptions\ExceptionInterface $e)
        {
            $this->exe->flash->set('errors', $e->getMessages());
        }

        return $this->exe->redirect->previous();
    }
}