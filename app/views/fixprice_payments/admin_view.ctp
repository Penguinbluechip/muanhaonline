<div class="fixpricePayments view">
<h2><?php  __('Fixprice Payment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpricePayment['FixpricePayment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpricePayment['FixpricePayment']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpricePayment['FixpricePayment']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fixprice Payment', true), array('action' => 'edit', $fixpricePayment['FixpricePayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fixprice Payment', true), array('action' => 'delete', $fixpricePayment['FixpricePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpricePayment['FixpricePayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Payments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Payment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fixprice Orders');?></h3>
	<?php if (!empty($fixpricePayment['FixpriceOrder'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Profile Id'); ?></th>
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
		foreach ($fixpricePayment['FixpriceOrder'] as $fixpriceOrder):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fixpriceOrder['id'];?></td>
			<td><?php echo $fixpriceOrder['user_profile_id'];?></td>
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
