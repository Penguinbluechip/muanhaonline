<div class="fixpriceOrders view">
<h2><?php  __('Fixprice Order');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrder['FixpriceOrder']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fixprice Customer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceCustomer']['name'], array('controller' => 'fixprice_customers', 'action' => 'view', $fixpriceOrder['FixpriceCustomer']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['User']['username'], array('controller' => 'users', 'action' => 'view', $fixpriceOrder['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['Product']['name'], array('controller' => 'products', 'action' => 'view', $fixpriceOrder['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fixprice Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fixprice Service'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceService']['name'], array('controller' => 'fixprice_services', 'action' => 'view', $fixpriceOrder['FixpriceService']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fixprice Payment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceOrder['FixpricePayment']['name'], array('controller' => 'fixprice_payments', 'action' => 'view', $fixpriceOrder['FixpricePayment']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Create Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceOrder['FixpriceOrder']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fixprice Order', true), array('action' => 'edit', $fixpriceOrder['FixpriceOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fixprice Order', true), array('action' => 'delete', $fixpriceOrder['FixpriceOrder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceOrder['FixpriceOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Customers', true), array('controller' => 'fixprice_customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Customer', true), array('controller' => 'fixprice_customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Types', true), array('controller' => 'fixprice_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Type', true), array('controller' => 'fixprice_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Services', true), array('controller' => 'fixprice_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Service', true), array('controller' => 'fixprice_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Payments', true), array('controller' => 'fixprice_payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Payment', true), array('controller' => 'fixprice_payments', 'action' => 'add')); ?> </li>
	</ul>
</div>
