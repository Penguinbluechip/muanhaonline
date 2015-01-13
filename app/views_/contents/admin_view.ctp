<div class="contents view">
<h2><?php  __('Content');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $content['Content']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Content Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($content['ContentCategory']['name'], array('controller' => 'content_categories', 'action' => 'view', $content['ContentCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $content['Content']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Content'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $content['Content']['content']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Content', true), array('action' => 'edit', $content['Content']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Content', true), array('action' => 'delete', $content['Content']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $content['Content']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contents', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Content Categories', true), array('controller' => 'content_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content Category', true), array('controller' => 'content_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
