<?php $this->set('title', 'New Project');?>
<p>Please complete it.. Em, I mean, please complete the form.</p>
<div class="row">
	<div class='col-sm-6'>
		<form action="" method="POST" role="form">
			<div class="form-group">
				<label for="">Project Name</label>
				<?php echo $form->text('name')->attr('class="form-control"');?>
			</div>
			<div class="form-group">
				<label>About</label>
				<?php echo $form->textarea('description')->attr('class="form-control" style="height: 180px;"');?>
			</div>
			<div class="form-group">
				<label>Dates</label>
				<div>
				<?php echo $form->date('date_start')->attr('class="form-control" style="display: inline; width: 48%;"');?> to 
				<?php echo $form->date('date_end')->attr('class="form-control" style="display: inline; width: 48%;"');?>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>