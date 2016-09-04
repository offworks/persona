<?php
namespace Persona\Admin\Controller;

class Blog extends Base
{
	public function getIndex(array $params)
	{
		$page = isset($params[0]) ? $params[0] : 1;

		$limit = 5;

		$query = \Persona\Entity\Article::where('user_id', $this->user->id)->orderBy('id', 'desc');

		$total = $query->count();

		$articles = $query->forPage($page, $limit)->get();

		return $this->render('blog/index', array(
			'articles' => $articles,
			'paginator' => new \JasonGrimes\Paginator($total, $limit, $page, $this->exe->url->admin('blog', 'index/(:num)'))
			));
	}

	public function xpostBodyPreview(array $params)
	{
		$parser = new \cebe\markdown\GithubMarkdown();

		// markdown translate.
		$html = $parser->parse($params['body']);

		return $html;
	}

	public function getCreate(array $params)
	{
		$categories = \Persona\Entity\Category::get();

		return $this->render('blog/create', array(
			'categories' => $categories->pluck('name', 'id')->toArray(),
			'flash' => $this->exe->flash
			));
	}

	public function postCreate(array $params)
	{
		$validator = \v::attribute('title', \v::notEmpty())->attribute('body', \v::notEmpty());

		try
		{
			$validator->assert((object) $params);

			$article = new \Persona\Entity\Article;
			$article->user_id = $this->user->id;
			$article->title = $params['title'];
			$article->slug = str_slug($article->title);
			$article->published_at = $params['published_at'];
			$article->category_id = isset($params['category_id']) ? $params['category_id'] : 0;
			$article->body = $params['body'];
			$article->save();
		}
		catch(\Respect\Validation\Exceptions\ExceptionInterface $e)
		{
			$this->exe->flash->set('errors', $e->getMessages());

			return $this->exe->redirect->previous();
		}

		$this->exe->flash->set('message', 'New article added!');

		return $this->exe->redirect->admin('blog', 'index');
	}

	public function getUpdate(array $params)
	{
		$form = $this->exe->form;

		$article = \Persona\Entity\Article::find($params[0]);

		$form->set('title', $article->title);
		$form->set('body', $article->body);
		$form->set('category_id', $article->category_id);
		$form->set('published_at', $article->published_at);

		return $this->render('blog/update', array(
			'article' => $article,
			'categories' => \Persona\Entity\Category::get()->pluck('name', 'id')->toArray(),
			'flash' => $this->exe->flash
			));
	}

	public function getDelete(array $params)
	{
		$id = $params[0];

		$article = \Persona\Entity\Article::find($id);

		$article->delete();

		$this->exe->flash->set('message', 'Article successfully deleted.');

		return $this->exe->redirect->previous();
	}

	public function postUpdate(array $params)
	{
		$article = \Persona\Entity\Article::find($params[0]);

		$article->title = $params['title'];
		
		if(!$article->slug)
			$article->slug = str_slug($article->title);

		$article->body = $params['body'];
		$article->category_id = $params['category_id'];
		$article->updated_at = \Carbon\Carbon::now();
		$article->save();

		$this->exe->flash->set('message', 'Article updated.');

		return $this->exe->redirect->url($this->exe->url->previous());
	}
}