<style type="text/css">
	
.header
{
	padding: 10px;
	text-align: right;
}

</style>
<div class='header'>
	<a href="<?php echo $url->web();?>"><span class='fa fa-home'></span> Home</a> |
	<?php if($exe->isLoggedIn()):?>
		<a href='<?php echo $url->admin();?>'>Dashboard</a>
	<?php else:?>
		<a href="javascript: persona.modal('<?php echo $url->route('@web.login');?>');"><span class='fa fa-key'></span> Log In</a>
	<?php endif;?>
</div>