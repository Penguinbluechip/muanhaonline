<div class="expertGroups view">
<h2><?php  __('Expert Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $expertGroup['ExpertGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $expertGroup['ExpertGroup']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Expert Group', true), array('action' => 'edit', $expertGroup['ExpertGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Expert Group', true), array('action' => 'delete', $expertGroup['ExpertGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $expertGroup['ExpertGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Expert Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expert Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
	
	<?php echo $this->element('supervisorfixpricesidebar'); ?>
</div>
