<?php
namespace Persona\Entity;

use cebe\markdown\GithubMarkdown;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends \Laraquent\Entity
{
	use SoftDeletes;

	protected $table = 'article';

	protected $visible = array(
		'id', 'title', 'body', 'published_date'
		);

	public function getParsedBody()
	{
		$parser = new GithubMarkdown();

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