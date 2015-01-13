<div class="certificates view">
<h2><?php  __('Certificate');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $certificate['Certificate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $certificate['Certificate']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $certificate['Certificate']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Certificate', true), array('action' => 'edit', $certificate['Certificate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Certificate', true), array('action' => 'delete', $certificate['Certificate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $certificate['Certificate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Certificates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Certificate', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
