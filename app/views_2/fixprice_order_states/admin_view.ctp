<div class="fixpriceOrderStates view">
<h2><?php  __('Fixprice Order State');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrderState['FixpriceOrderState']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrderState['FixpriceOrderState']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrderState['FixpriceOrderState']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fixprice Order State', true), array('action' => 'edit', $fixpriceOrderState['FixpriceOrderState']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fixprice Order State', true), array('action' => 'delete', $fixpriceOrderState['FixpriceOrderState']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceOrderState['FixpriceOrderState']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Order States', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order State', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
