<?php
namespace Persona\Entity;

class Category extends \Laraquent\Base
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $table = 'category';

	public function __toString()
	{
		return $this->name;
	}
}