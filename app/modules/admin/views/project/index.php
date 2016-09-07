<?php $this->set('title', 'Projects');?>
<p>List of your projects. Basically. <a href='<?php echo $url->admin('project', 'create');?>' class='fa fa-plus'></a></p>
<div class="row">
	<div class='col-sm-6'>
		<div class='table-responsive'>
			<table class='table'>
				<tr>
					<th width="15px">No.</th>
					<th>Name</th>
					<td width="15px"></td>
				</tr>
				<?php foreach($projects as $project):?>
				<tr>
					<td><?php echo !isset($no) ? 1 : $no = $no + 1;?></td>
					<td><a href='<?php echo $url->admin('project', 'update/'.$project->id);?>'><?php echo $project->name;?></a></td>
					<td><a href='<?php echo $url->admin('project', 'delete/'.$project->id);?>' class='fa fa-times'></a></td>
				</tr>
				<?php endforeach;?>
				<?php if($projects->count() == 0):?>
				<tr>
					<td colspan="2" align="center">You've no project at all, bro.</td>
				</tr>
				<?php endif;?>
			</table>
		</div>
	</div>
</div>