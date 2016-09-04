<?php $this->set('title', 'User Profile');?>
<p>Set your user information. <a href='<?php echo $url->admin('user', 'password');?>'>Change Password</a></p>
<div class="row">
	<div class="col-sm-6">
		<form action="" method="POST" role="form">
			<div class='form-group'>
				<label>Name</label>
				<?php echo $form->text('name')->attr('class="form-control"');?>
			</div>
			<div class='form-group'>
				<label>Email</label>
				<?php echo $form->text('email')->attr('class="form-control"');?>
			</div>
			<div class='form-group'>
				<label>About</label>
				<?php echo $form->textarea('about')->attr('class="form-control" style="height: 150px;"');?>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<div class="row">

</div>
