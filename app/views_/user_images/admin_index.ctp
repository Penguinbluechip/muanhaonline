<div class="userImages index">
	<h2><?php __('User Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_profile_id');?></th>
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
	foreach ($userImages as $userImage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userImage['UserImage']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userImage['UserProfile']['name'], array('controller' => 'user_profiles', 'action' => 'view', $userImage['UserProfile']['id'])); ?>
		</td>
		<td><?php echo $userImage['UserImage']['title']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['description']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['type']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['filename']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['dir']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['mimetype']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['filesize']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['created']; ?>&nbsp;</td>
		<td><?php echo $userImage['UserImage']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $userImage['UserImage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $userImage['UserImage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $userImage['UserImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userImage['UserImage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Image', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List User Profiles', true), array('controller' => 'user_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Profile', true), array('controller' => 'user_profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>