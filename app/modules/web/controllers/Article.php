<?php
namespace Persona\Web\Controller;

class Article extends Base
{
	public function getIndex()
	{
		
	}

	public function getByCategory()
	{

	}
	
	public function getView()
	{
		$article = \Persona\Entity\Article::where('slug', $this->exe->param('slug'))->first();

		return $this->render('article/view', array(
			'article' => $article
			));
	}
}