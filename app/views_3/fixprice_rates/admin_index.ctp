<div class="fixpriceRates index">
	<h2><?php __('Fixprice Rates');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('bonus');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceRates as $fixpriceRate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpriceRate['FixpriceRate']['id']; ?>&nbsp;</td>
		<td><?php echo $fixpriceRate['FixpriceRate']['name']; ?>&nbsp;</td>
		<td><?php echo $fixpriceRate['FixpriceRate']['description']; ?>&nbsp;</td>
		<td><?php echo $fixpriceRate['FixpriceRate']['bonus']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fixpriceRate['FixpriceRate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fixpriceRate['FixpriceRate']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fixpriceRate['FixpriceRate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceRate['FixpriceRate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fixprice Rate', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>