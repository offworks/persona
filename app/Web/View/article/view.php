<?php $this->set('title', $article->title);?>
<style type="text/css">
	
.blog-post-body
{
	font-size: 21px;
}

.blog-post-body pre
{
	font-size: 19px;
}

</style>
<div class="row">
	<div class='col-sm-9'>
		<div class='blog-post-title'>
			<?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->diffForHumans();?>
		</div>
		<div class="blog-post-body">
		   <?php echo $article->getParsedBody();?>
		</div>
	</div>
</div>