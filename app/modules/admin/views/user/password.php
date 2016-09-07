<?php $this->set('title', 'Change user password');?>
<p>No explanation needed.</p>
<div class="row">
	<div class="col-sm-6">
		<form action="" method="POST" role="form">
			<div class="form-group">
				<label for="">New Password</label>
				<?php echo $form->password('password')->attr('class="form-control"');?>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>