<div class="projects index">
	<h2><?php __('Projects');?></h2>
	
	<?php echo $this->render('_filter', '');?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo __('Image');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('city_id');?></th>
			<th><?php echo $this->Paginator->sort('district_id');?></th>
			
			<th><?php echo $this->Paginator->sort('street');?></th>
			<th><?php echo $this->Paginator->sort('home_number');?></th>
			<th><?php echo $this->Paginator->sort('new');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projects as $project):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $project['Project']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->image("/uploads/project_image/filename/thumb/admin/".$project["ProjectImage"]["filename"], array('title' => $project["ProjectImage"]["title"])); ?>
		</td>
		<td><?php echo $project['Project']['name']; ?>&nbsp;</td>
		<td><?php echo $project['City']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $project['District']['name']; ?>
		</td>
		
		<td><?php echo $project['Project']['street']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['home_number']; ?>&nbsp;</td>
		
		<td><?php
		
			if($project['Project']['new'])
			{
				$name = __('yes', true);
			}
			else
			{
				$name = __('no', true);
			}
			echo $this->Html->link($name, array('action' => 'topnew', $project['Project']['id']));
		
		?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $project['Project']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Project', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>