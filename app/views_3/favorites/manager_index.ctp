<h1 class="page-title">Quản trị >> Bất động sản quan tâm</h1>
<div class="products index">
	<h2><?php __('Các tin BĐS được lưu trữ');?></h2>
	
	<?php //echo $this->render('_filter', '');?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th>Ảnh</th>
			<th>Tên</th>
			<th>Dành cho</th>
			<th>Loại</th>
			<!--<th><?php __('Address');?></th>
			<th>Dự án</th>-->
			

		
			<th>Giá</th>

			
			

			<th class="actions">Điều khiển</th>
			<!--<th>Trạng thái</th>-->
	</tr>
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td>
			<?php echo $this->Html->image("/uploads/product_image/filename/thumb/admin/".$product["ProductImage"]["filename"], array('title' => $product["ProductImage"]["title"])); ?>
		</td>
		<td><a href="<?php echo $this->Html->url($product['Product']['link']) ?>" target="_blank"><?php echo $product['Product']['name']; ?>&nbsp;</a></td>
		<td><?php echo $product['Product']['for'] == 's' ? 'Bán' : 'Thuê'; ?>&nbsp;</td>
		<td>
			<?php echo $product['Category']['name']; ?>
		</td>		
		
		<td><?php echo $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",")." " : ""; ?><?php echo $product['CurrencyPrice']['code'].$product['Product']['price_perm2']; ?>&nbsp;</td>
		
		<td class="actions" style="text-align: right">			
			<?php echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Favorite']['id']), null, sprintf(__('Bạn có muốn xóa sản phẩm khỏi lưu trữ?', true), $product['Favorite']['id'])); ?>
		</td>
		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page% / %pages%, hiển thị %current% trên %count% sản phẩm, từ %start% - %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('trước', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('adminsidebar'); ?>
</div>