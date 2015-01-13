<div class="needs index">
	<h2><?php __('Needs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>			
			<th><?php echo $this->Paginator->sort('city_id');?></th>

			<th><?php echo $this->Paginator->sort('create_date');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($needs as $need):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td>
			<?php echo $this->Html->link($need['User']['username'], array('controller' => 'users', 'action' => 'view', $need['User']['id'])); ?>
		</td>
		<td><?php echo $need['Need']['name']; ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link($need['City']['name'], array('controller' => 'cities', 'action' => 'view', $need['City']['id'])); ?>
		</td>
		
		<td><?php echo $need['Need']['create_date']; ?>&nbsp;</td>
		<td class="actions">			
			<?php echo $this->Html->link(__('View/Edit', true), array('action' => 'edit', $need['Need']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $need['Need']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $need['Need']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Need', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>