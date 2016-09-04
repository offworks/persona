<?php
namespace Persona\Admin\Controller;

class Project extends Base
{
	public function getIndex()
	{
		return $this->render('project/index', array(
			'projects' => \Persona\Entity\Project::get()
			));
	}

	public function getCreate()
	{
		return $this->render('project/create');
	}

	public function postCreate(array $params)
	{
		$validator = \v::attribute('name', \v::notEmpty())
		->attribute('description', \v::notEmpty());

		try
		{
			$validator->assert((object) $params);

			$project = new \Persona\Entity\Project;
			$project->name = $params['name'];
			$project->description = $params['description'];
			$project->date_start = $params['date_start'];
			$project->date_end = $params['date_end'];
			$project->save();

			$this->exe->flash->set('message', 'Project ['.$project->name.'] added.');
		}
		catch(\Respect\Validation\Exceptions\ExceptionInterface $e)
		{
			$this->exe->flash->set('errors', $e->getMessages());

			return $this->exe->redirect->previous();
		}

		return $this->exe->redirect->admin('project');
	}

	public function getDelete(array $params)
	{
		$project = \Persona\Entity\Project::find($params[0]);

		$this->exe->flash->set('message', 'Successfully deleted project ['.$project->name.']');

		$project->delete();

		return $this->exe->redirect->previous();
	}

	public function getUpdate(array $params)
	{
		$project = \Persona\Entity\Project::find($params[0]);

		$this->exe->form->set(array(
			'name' => $project->name,
			'description' => $project->description,
			'date_start' => date('Y-m-d', strtotime($project->date_start)),
			'date_end' => date('Y-m-d', strtotime($project->date_end))
			));

		return $this->render('project/update', array(
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