<style type="text/css">
	
.blog-index-title
{
	font-size: 40px;
}

.blog-index-list
{
	padding-top: 20px;
}

.blog-post-title
{
	font-size:35px;
	font-weight: bold;
}

.blog-post-title a
{
	color: black;
}

.blog-post-meta
{
	color: grey;
}

.blog-post-body
{
	margin-top: 10px;
	margin-bottom: 60px;
}

.blog-post-body *
{
	font-size: 21px;
}

.blog-post-body pre
{
	font-size: 16px;
}

</style>
<div class='row'>
	<div class='col-sm-9'>
		<div class='blog-index-list'>
			<?php if($articles->count() == 0):?>
				Oops, i wish i had more blogs count. Guess what, i am not even ready yet!
			<?php endif;?>
			<?php foreach($articles as $article):?>
				<div class='blog-post'>
					<div class='blog-post-title'>
					<a href='<?php echo $url->route('@web.articles.article', array('slug' => $article->slug));?>'><?php echo $article->title;?></a>
					</div>
					<div class='blog-post-meta'>
						Written <?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->diffForHumans();?>
					</div>
					<div class='blog-post-body'>
					<?php echo $article->getParsedBody();?>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</div>