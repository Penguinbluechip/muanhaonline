<div class="needTypes view">
<h2><?php  __('Need Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $needType['NeedType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $needType['NeedType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $needType['NeedType']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Need Type', true), array('action' => 'edit', $needType['NeedType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Need Type', true), array('action' => 'delete', $needType['NeedType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $needType['NeedType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Need Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Need Type', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
