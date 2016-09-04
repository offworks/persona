<?php

$schema->table('article', function($table)
{
	$table->increments('id');
	$table->integer('user_id');
	$table->integer('category_id');
	$table->string('title');
	$table->text('body');
	$table->datetime('published_at');
	$table->string('slug');
	$table->timestamps();
	$table->softDeletes();
});

$schema->table('category', function($table)
{
	$table->increments('id');
	$table->string('name');
	$table->string('slug');
	$table->text('description');
	$table->integer('created_by');
	$table->timestamps();
	$table->softDeletes();
});

$schema->table('article_tag', function($table)
{
	$table->increments('id');
	$table->integer('article_id');
	$table->string('name');
	$table->timestamps();
});

$schema->table('user', function($table)
{
	$table->increments('id');
	$table->string('email');
	$table->string('password');
	$table->string('name');
	$table->text('about');
	$table->timestamps();
});

$schema->table('project', function($table)
{
	$table->increments('id');
	$table->string('name');
	$table->text('description');
	$datetime = $table->datetime('date_start');
	
	if($datetime)
		$datetime->nullable();

	$datetime = $table->datetime('date_end');

	if($datetime)
		$datetime->nullable();

	$table->timestamps();

	$table->softDeletes();
});

$schema->table('settings', function($table)
{
	$table->increments('id');
	$table->string('test');
	$table->timestamps();
});