<?php $this->set('script', function() use($url) { ?>
<script type="text/javascript">
var reference = new function()
{
	this.addField = function()
	{
		var el = '<input type="text" class="form-control" name="references[]">';
		$("#reference-container").append(el);
	}
};

var article = new function()
{
	this.preview = function()
	{
		var body = $('#body').val();

		$.post({url: '<?php echo $url->admin("blog", "bodyPreview");?>', data: {body: body}}).done(function(text)
		{
			$('.article-preview-title').html($('#title').val());
			$('.article-edit').hide();
			$('.article-preview').html(text).show();
		});
	}

	this.edit = function()
	{
		$('.article-preview').hide();
		$('.article-edit').show();
		$('.article-preview-title').html('');
	};
};
</script>
<?php });?>
<?php $this->set('title', $article->title);?>
<style type="text/css">

.article-preview-title
{
	font-size: 40px;
}

.article-preview
{
	min-height: 30px;
}

</style>
<p>Update this article</p>
<div class="row">
	<form action="" method="POST" role="form">
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<div style="margin-bottom: 10px; height: 20px;">
				   	<span class='pull-right'>
			   			<a href='javascript: article.edit();'>Edit</a> | 
			   			<a href='javascript: article.preview();'>Preview</a>
			   		</span>
				</div>
		   		<div class='article-edit'>
				   	<div class="form-group">
				   		<div class="row">
				   			<div class="col-sm-6">
						   		<label>Title</label>
						   		<?php echo $form->text('title')->attr('class="form-control" tabindex="1"');?>
				   			</div>
				   			<div class="col-sm-3">
						   		<label for="">Publishing Date</label>
			   					<?php echo $form->date('published_at')->attr('class="form-control" tabindex="3"')->value(date('Y-m-d'));?>
				   			</div>
				   			<div class="col-sm-3">
						   		<label>Category <a href='javascript:persona.modal("<?php echo $url->admin('settings', 'categoryAdd');?>");' class='fa fa-plus'></a></label>
						   		<?php echo $form->select('category_id')->options($categories)->attr('class="form-control" tabindex="4"')->first('', '-- Select Category --');?>
				   			</div>
				   			
				   		</div>
				   	</div>
				   	<div class='form-group'>
				   		<label for="">Body </label>
				   		<div class='article-body'><?php echo $form->textarea("body")->attr('class="form-control" style="height:300px;" tabindex="2"');?></div>
				   	</div>
			   	</div>
			   	<div class='article-preview-title'></div>
			   	<div class='article-preview'>
			   	</div>
			   	<button type="submit" class="btn btn-primary">Submit</button>
			   
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<legend>Others</legend>
				<div class="form-group">
					<label>Tags</label>
			   		<?php echo $form->text('tags')->attr('class="form-control"');?>
			   	</div>
			   	<div class="form-group">
			   		<label for="">References <a onclick='reference.addField();' href='javascript:void(0);'>+</a></label>
			   		<div id='reference-container'>
			   		<?php if($flash->has("form_data.references")):?>
			   			<?php foreach($flash->get("form_data.references") as $val):?>
			   				<input type="text" class="form-control" name='references[]' value='<?php echo $val;?>'>
			   			<?php endforeach;?>
			   		<?php else:?>
			   			<input type="text" class="form-control" name='references[]'>
			   		<?php endif;?>
			   		</div>
			   	</div>
			</div>
		</div>
	</div>
	</form>
</div>