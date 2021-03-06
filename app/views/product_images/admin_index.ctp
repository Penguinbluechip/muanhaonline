<div class="productImages index">
	<h2><?php __('Product Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('filename');?></th>
			<th><?php echo $this->Paginator->sort('dir');?></th>
			<th><?php echo $this->Paginator->sort('mimetype');?></th>
			<th><?php echo $this->Paginator->sort('filesize');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($productImages as $productImage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $productImage['ProductImage']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productImage['Product']['name'], array('controller' => 'products', 'action' => 'view', $productImage['Product']['id'])); ?>
		</td>
		<td><?php echo $productImage['ProductImage']['title']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['description']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['type']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['filename']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['dir']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['mimetype']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['filesize']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['created']; ?>&nbsp;</td>
		<td><?php echo $productImage['ProductImage']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $productImage['ProductImage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $productImage['ProductImage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productImage['ProductImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productImage['ProductImage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Product Image', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>