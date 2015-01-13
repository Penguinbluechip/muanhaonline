<div class="fixpriceOrders index">
	<h2><?php __('Fixprice Orders');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_customer_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('expert_id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th style="display: none"><?php echo $this->Paginator->sort('fixprice_type_id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_service_id');?></th>
			
			<th><?php echo $this->Paginator->sort('create_date');?></th>
			<th>Hạn còn lại</th>
			<th style="display: none"><?php echo $this->Paginator->sort('status');?></th>
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
			<?php echo $this->Html->link($fixpriceOrder['FixpriceCustomer']['name'], array('controller' => 'fixprice_customers', 'action' => 'view', $fixpriceOrder['FixpriceCustomer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['User']['username'], array('controller' => 'users', 'action' => 'view', $fixpriceOrder['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['Expert']['username'], array('controller' => 'users', 'action' => 'view', $fixpriceOrder['Expert']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['Product']['name'], array('controller' => 'products', 'action' => 'view', $fixpriceOrder['Product']['id'])); ?>
		</td>
		<td style="display: none">
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceService']['name'], array('controller' => 'fixprice_services', 'action' => 'view', $fixpriceOrder['FixpriceService']['id'])); ?>
		</td>
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td><?php if(isset($fixpriceOrder['remain_hours'])) echo $fixpriceOrder['remain_hours'].' tiếng'; ?>&nbsp;</td>
		<td style="display: none"><?php echo $fixpriceOrder['FixpriceOrder']['status']; ?>&nbsp;</td>
		<td class="actions">
			
			<?php if($fixpriceOrder['FixpriceOrder']['status'] == 1) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'admin'=>true), false); ?>" target="_blank">View</a>				
				<?php echo $this->Html->link(__('Paid', true), array('action' => 'setpaidnl', $fixpriceOrder['FixpriceOrder']['id'])); ?>				
			<?php } elseif($fixpriceOrder['FixpriceOrder']['status'] == 2) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'admin'=>true), false); ?>" target="_blank">View</a>
				<?php echo $this->Html->link(__('Assign Expert', true), array('action' => 'assign', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } elseif($fixpriceOrder['FixpriceOrder']['status'] == 3) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'admin'=>true), false); ?>" target="_blank">View</a>
				<?php echo $this->Html->link(__('Assign Expert', true), array('action' => 'assign', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } elseif($fixpriceOrder['FixpriceOrder']['status'] == 4) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'admin'=>true), false); ?>" target="_blank">View</a>				
				<?php echo $this->Html->link(__('Valid', true), array('action' => 'valid', $fixpriceOrder['FixpriceOrder']['id'])); ?>
				<?php echo $this->Html->link(__('Invalid', true), array('action' => 'invalid', $fixpriceOrder['FixpriceOrder']['id'])); ?>
				
				<?php echo $this->Html->link(__('Assign Expert', true), array('action' => 'assign', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } elseif($fixpriceOrder['FixpriceOrder']['status'] == -1) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'admin'=>true), false); ?>" target="_blank">View</a>
				<?php echo $this->Html->link(__('Assign Expert', true), array('action' => 'assign', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } ?>
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
	<?php echo $this->element('adminfixpricesidebar'); ?>
	
</div>