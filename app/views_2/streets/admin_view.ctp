<div class="streets view">
<h2><?php  __('Street');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $street['Street']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($street['City']['name'], array('controller' => 'cities', 'action' => 'view', $street['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $street['Street']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $street['Street']['order']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Street', true), array('action' => 'edit', $street['Street']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Street', true), array('action' => 'delete', $street['Street']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $street['Street']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Streets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Street', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Districts');?></h3>
	<?php if (!empty($street['District'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('City Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Alias'); ?></th>
		<th><?php __('Order'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($street['District'] as $district):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $district['id'];?></td>
			<td><?php echo $district['city_id'];?></td>
			<td><?php echo $district['name'];?></td>
			<td><?php echo $district['alias'];?></td>
			<td><?php echo $district['order'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'districts', 'action' => 'view', $district['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'districts', 'action' => 'edit', $district['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'districts', 'action' => 'delete', $district['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $district['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
