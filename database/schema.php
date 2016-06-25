<?php

$schema->table('article', function($table)
{
	$table->increments('id');
	$table->integer('category_id');
	$table->string('title');
	$table->text('body');
	$table->datetime('published_date');
	$table->timestamps();
});

$schema->table('category', function($table)
{
	$table->increments('id');
	$table->string('title');
	$table->string('slug');
	$table->text('description');
	$table->timestamps();
});

$schema->table('article_tag', function($table)
{
	$table->increments('id');
	$table->integer('article_id');
	$table->string('name');
	$table->timestamps();
});