<div class="orderTypes view">
<h2><?php  __('Order Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orderType['OrderType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orderType['OrderType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orderType['OrderType']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orderType['OrderType']['price']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Type', true), array('action' => 'edit', $orderType['OrderType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Order Type', true), array('action' => 'delete', $orderType['OrderType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderType['OrderType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
