<?php $this->set('title', 'Your blog posts');?>
<p>Basically a list of your articles. <a href='<?php echo $url->admin('blog', 'create');?>' class='fa fa-plus'></a></p>
<div class='table=responsive'>
	<table class='table'>
		<tr>
			<th style="width: 10px;">No.</th>
			<th style="">Title</th>
			<td></td>
			<th style="width: 150px;">Written at</th>
			<td style="width: 15px;"></td>
		</tr>
		<?php foreach($articles as $article):?>
		<tr>
			<td><?php echo !isset($no) ? $no = 1 : $no = $no + 1;?>.</td>
			<td><a style="font-size: 20px;" href='<?php echo $url->admin('blog', 'update', array($article->id));?>'><?php echo $article->title;?></a></td>
			<td><?php if($article->category):?>
				<?php echo $article->category;?>
				<?php endif;?>
			</td>
			<td><?php echo $article->created_at;?></td>
			<td><a class='fa fa-times' href='<?php echo $url->admin('blog', 'delete', array($article->id));?>'></a></td>
		</tr>
		<?php endforeach;?>
		<?php if($articles->count() == 0):?>
		<tr>
			<td align="center" colspan="3">Can't find any~!</td>
		</tr>
		<?php endif;?>
	</table>
	<div>
		<?php echo $paginator;?>
	</div>
</div>