<?php
namespace Persona\Entity;

class Article extends \Laraquent\Base
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'article';

	protected $visible = array(
		'id', 'title', 'body', 'published_date'
		);

	public function getParsedBody()
	{
		$parser = new \cebe\markdown\GithubMarkdown();

		return $parser->parse($this->body);
	}

	public function relateUser()
	{
		return $this->hasOne('\Persona\Entity\User', 'id', 'user_id');
	}

	public function relateCategory()
	{
		return $this->hasOne('\Persona\Entity\Category', 'id', 'category_id');
	}
}