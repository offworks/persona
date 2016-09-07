<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php echo $view->get('title');?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url->asset('css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $url->asset('css/bootstrap-theme.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $url->asset('css/font-awesome/font-awesome.min.css');?>">
	<script type="text/javascript" src="<?php echo $url->asset('js/jquery-2.2.4.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo $url->asset('js/bootstrap.min.js');?>"></script>
	<style type="text/css">

	#main-content
	{
		margin-top: 100px;
	}
	</style>
	<script type="text/javascript">
	var persona = new function($)
	{
		// @param string url absolute
		this.modal = function(url)
		{
			$.get({url: url}).done(function(html)
			{
				$('#wrapper-modal').html(html).modal('show');
			});
		};
	}(jQuery);

	</script>
	<!-- view-based scripts -->
	<?php if($view->has('script')):?>
	<?php echo $view->get('script')->__invoke();?>
	<?php endif;?>
	<style type="text/css">
	body
	{
		font-family: Georgia;
	}

	.header
	{
		padding: 10px;
		text-align: right;
	}

	.main-content-title
	{
		font-size: 35px;
		font-weight: bold;
	}
	</style>
</head>
<body>
<div class='container' id='header'>
	<div class='header'>
		<strong class='pull-left'>Welcome back, <?php echo $user->name;?>!</strong>
		<!-- <a href="<?php echo $url->admin('dashboard');?>">Dashboard</a> |  -->
		<a href="<?php echo $url->web('/');?>"><span class='fa fa-angle-left'></span> Web</a> |
		<a href="<?php echo $url->admin('blog');?>"><span class='fa fa-list'></span> Blog</a> |
		<a href="<?php echo $url->admin('project');?>"><span class='fa fa-send-o'></span> Projects</a> |
		<a href="<?php echo $url->admin('user', 'settings');?>"><span class='fa fa-user'></span> Profile</a> |
		<a href="<?php echo $url->admin('settings', 'index');?>"><span class='fa fa-gear'></span> Settings</a> |
		<a href="<?php echo $url->admin('dashboard', 'logout');?>"><span class='fa fa-power-off'></span> Logout</a>
	</div>
</div>
<div class='container' id='main-content'>
	<h1 class='main-content-title'><?php echo $view->get('title');?></h1>
	<?php if($exe->flash->has('message')):?>
		<div class='alert bg-success'><?php echo $exe->flash->get('message');?></div>
	<?php endif;?>
	<?php if($exe->flash->has('errors')):?>
		<ul>
		<?php foreach($exe->flash->get('errors') as $error):?>
			<li><?php echo $error;?></li>
		<?php endforeach;?>
		</ul>
	<?php endif;?>
	<?php echo $view->render();?>
</div>
<div id='wrapper-modal' class="modal fade" role="dialog"></div>
</body>
</html>