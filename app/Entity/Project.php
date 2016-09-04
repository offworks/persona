<?php
namespace Persona\Entity;

class Project extends \Laraquent\Base
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $table = 'project';
}