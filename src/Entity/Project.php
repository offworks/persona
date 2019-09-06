<?php
namespace Persona\Entity;

use Laraquent\Entity;

class Project extends Entity
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $table = 'project';
}