<div class="fixpriceCustomers index">
	<h2><?php __('Fixprice Customers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceCustomers as $fixpriceCustomer):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpriceCustomer['FixpriceCustomer']['id']; ?>&nbsp;</td>
		<td><?php echo $fixpriceCustomer['FixpriceCustomer']['name']; ?>&nbsp;</td>
		<td><?php echo $fixpriceCustomer['FixpriceCustomer']['email']; ?>&nbsp;</td>
		<td><?php echo $fixpriceCustomer['FixpriceCustomer']['phone']; ?>&nbsp;</td>
		<td><?php echo $fixpriceCustomer['FixpriceCustomer']['address']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fixpriceCustomer['FixpriceCustomer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fixpriceCustomer['FixpriceCustomer']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fixpriceCustomer['FixpriceCustomer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceCustomer['FixpriceCustomer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fixprice Customer', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>