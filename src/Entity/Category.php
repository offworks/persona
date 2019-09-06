<?php
namespace Persona\Entity;

use Laraquent\Entity;

class Category extends Entity
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $table = 'category';

	public function __toString()
	{
		return $this->name;
	}
}