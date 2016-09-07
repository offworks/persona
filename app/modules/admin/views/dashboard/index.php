<style type="text/css">
.ul-recent-articles
{
	padding: 0px;
	list-style: none;
}

.ul-recent-articles li > div:nth-child(2)
{
	opacity: 0.8;
}

.ul-recent-articles li
{
	padding-bottom: 10px;
}
</style>
<?php $this->set('title', 'Dashboard');?>
<p>Just another boring dashboard.</p>
<div class='row'>
	<div class='col-sm-6'>
		<h2>Recent articles</h2>
		<ul class='ul-recent-articles'>
			<?php foreach($articles as $article):?>
			<li>
				<div><?php echo $article->title;?></div>
				<div><?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->diffForHumans();?></div>
			</li>
			<?php endforeach;?>
		</ul>
		<?php if($articles->count() == 0):?>
			<div>Please write something!</div>
		<?php endif;?>
	</div>
</div>