<?php
namespace App\Routing;

class BlogFactory extends \Exedra\Routing\Factory
{
	public function setUp()
	{
		parent::setUp();

		$this->register(array(
			'route' => \App\Routing\BlogRoute::class
			));
	}
}