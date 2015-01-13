<div class="fixpriceOrders index">
	<h2><?php __('Fixprice Orders');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_profile_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_type_id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_service_id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_payment_id');?></th>
			<th><?php echo $this->Paginator->sort('create_date');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceOrders as $fixpriceOrder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpriceOrder['FixpriceOrder']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['UserProfile']['name'], array('controller' => 'user_profiles', 'action' => 'view', $fixpriceOrder['UserProfile']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['User']['username'], array('controller' => 'users', 'action' => 'view', $fixpriceOrder['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['Product']['name'], array('controller' => 'products', 'action' => 'view', $fixpriceOrder['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceService']['name'], array('controller' => 'fixprice_services', 'action' => 'view', $fixpriceOrder['FixpriceService']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpricePayment']['name'], array('controller' => 'fixprice_payments', 'action' => 'view', $fixpriceOrder['FixpricePayment']['id'])); ?>
		</td>
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td><?php echo $fixpriceOrder['FixpriceOrder']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fixpriceOrder['FixpriceOrder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceOrder['FixpriceOrder']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List User Profiles', true), array('controller' => 'user_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Profile', true), array('controller' => 'user_profiles', 'action' => 'add')); ?> </li>
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