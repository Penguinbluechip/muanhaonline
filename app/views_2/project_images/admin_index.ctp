<div class="projectImages index">
	<h2><?php __('Project Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('project_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('filename');?></th>
			<th><?php echo $this->Paginator->sort('dir');?></th>
			<th><?php echo $this->Paginator->sort('mimetype');?></th>
			<th><?php echo $this->Paginator->sort('filesize');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projectImages as $projectImage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $projectImage['ProjectImage']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($projectImage['Project']['name'], array('controller' => 'projects', 'action' => 'view', $projectImage['Project']['id'])); ?>
		</td>
		<td><?php echo $projectImage['ProjectImage']['title']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['description']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['type']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['filename']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['dir']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['mimetype']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['filesize']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['created']; ?>&nbsp;</td>
		<td><?php echo $projectImage['ProjectImage']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $projectImage['ProjectImage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $projectImage['ProjectImage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $projectImage['ProjectImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectImage['ProjectImage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Project Image', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>