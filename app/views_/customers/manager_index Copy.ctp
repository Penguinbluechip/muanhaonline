<div class="customers index">
	<h2><?php __('Danh sách khách hàng liên hệ');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th>Sản phẩm</th>
			<th>Tên khách hàng</th>
			<th>Điện thoại</th>
			<th>Email</th>
			<th>Thông điệp</th>
			<th class="actions">Chúc năng</th>
	</tr>
	<?php
	$i = 0;
	foreach ($customers as $customer):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		
		<td>
			<?php echo $this->Html->link($customer['Product']['name'], array('controller' => 'products', 'action' => 'view', $customer['Product']['id'])); ?>
		</td>
		<td><?php echo $customer['Customer']['name']; ?>&nbsp;</td>
		<td><?php echo $customer['Customer']['phone']; ?>&nbsp;</td>
		<td><?php echo $customer['Customer']['email']; ?>&nbsp;</td>
		<td><?php echo $customer['Customer']['message']; ?>&nbsp;</td>
		<td class="actions">			
			<?php echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $customer['Customer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customer['Customer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page% / %pages%, hiển thị %current% trên %count% khách hàng, từ %start% - %end%', true)
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
	<h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Danh sách', true), array('action' => 'index')); ?></li>
		
	</ul>
</div>