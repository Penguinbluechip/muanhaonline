<div class="fixpricePayments index">
	<h2><?php __('Fixprice Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpricePayments as $fixpricePayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpricePayment['FixpricePayment']['id']; ?>&nbsp;</td>
		<td><?php echo $fixpricePayment['FixpricePayment']['name']; ?>&nbsp;</td>
		<td><?php echo $fixpricePayment['FixpricePayment']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fixpricePayment['FixpricePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fixpricePayment['FixpricePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fixpricePayment['FixpricePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpricePayment['FixpricePayment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fixprice Payment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>