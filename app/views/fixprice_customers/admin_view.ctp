<div class="fixpriceCustomers view">
<h2><?php  __('Fixprice Customer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceCustomer['FixpriceCustomer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceCustomer['FixpriceCustomer']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceCustomer['FixpriceCustomer']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceCustomer['FixpriceCustomer']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceCustomer['FixpriceCustomer']['address']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fixprice Customer', true), array('action' => 'edit', $fixpriceCustomer['FixpriceCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fixprice Customer', true), array('action' => 'delete', $fixpriceCustomer['FixpriceCustomer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceCustomer['FixpriceCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Customers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Customer', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fixprice Orders');?></h3>
	<?php if (!empty($fixpriceCustomer['FixpriceOrder'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Fixprice Customer Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Fixprice Type Id'); ?></th>
		<th><?php __('Fixprice Service Id'); ?></th>
		<th><?php __('Fixprice Payment Id'); ?></th>
		<th><?php __('Create Date'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fixpriceCustomer['FixpriceOrder'] as $fixpriceOrder):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fixpriceOrder['id'];?></td>
			<td><?php echo $fixpriceOrder['fixprice_customer_id'];?></td>
			<td><?php echo $fixpriceOrder['user_id'];?></td>
			<td><?php echo $fixpriceOrder['product_id'];?></td>
			<td><?php echo $fixpriceOrder['fixprice_type_id'];?></td>
			<td><?php echo $fixpriceOrder['fixprice_service_id'];?></td>
			<td><?php echo $fixpriceOrder['fixprice_payment_id'];?></td>
			<td><?php echo $fixpriceOrder['create_date'];?></td>
			<td><?php echo $fixpriceOrder['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fixprice_orders', 'action' => 'view', $fixpriceOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fixprice_orders', 'action' => 'edit', $fixpriceOrder['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fixprice_orders', 'action' => 'delete', $fixpriceOrder['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
