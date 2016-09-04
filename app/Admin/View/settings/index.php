<?php $this->set('title', 'General Settings');?>
<p>General settings of your blog</p>
<div class="row">
	<div class='col-sm-6'>
		<h3>Categories <a href='javascript: persona.modal("<?php echo $url->admin('settings', 'categoryAdd');?>");' class='fa fa-plus'></a></h3>
		<div class='table-responsive'>
		<table class='table'>
			<tr>
				<th width="20px">No.</th>
				<th>Category</th>
				<th width="170px">Date added</th>
				<th width="20px"></th>
			</tr>
			<?php foreach($categories as $category):?>
			<tr>
				<td><?php echo !isset($no) ? $no = 1 : $no = $no + 1;?>.</td>
				<td><?php echo $category;?></td>
				<td><?php echo $category->created_at;?></td>
				<td>
					<a href='<?php echo $url->admin('settings', 'categoryDelete/'.$category->id);?>' class='fa fa-times'></a>
				</td>
			</tr>
			<?php endforeach;?>
		</table>
		</div>
	</div>
</div>
