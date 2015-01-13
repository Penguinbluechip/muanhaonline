<div class="fixpriceAnswers index">
	<h2><?php __('Fixprice Answers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fixprice_order_id');?></th>
			<th><?php echo $this->Paginator->sort('price_total');?></th>
			<th><?php echo $this->Paginator->sort('price_unit');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceAnswers as $fixpriceAnswer):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpriceAnswer['FixpriceAnswer']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fixpriceAnswer['FixpriceOrder']['user_profile_id'], array('controller' => 'fixprice_orders', 'action' => 'view', $fixpriceAnswer['FixpriceOrder']['id'])); ?>
		</td>
		<td><?php echo $fixpriceAnswer['FixpriceAnswer']['price_total']; ?>&nbsp;</td>
		<td><?php echo $fixpriceAnswer['FixpriceAnswer']['price_unit']; ?>&nbsp;</td>
		<td><?php echo $fixpriceAnswer['FixpriceAnswer']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fixpriceAnswer['FixpriceAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fixpriceAnswer['FixpriceAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fixpriceAnswer['FixpriceAnswer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceAnswer['FixpriceAnswer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fixprice Answer', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>