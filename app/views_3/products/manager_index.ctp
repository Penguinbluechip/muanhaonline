<h1 class="page-title">Dịch vụ chính >> Bất động sản</h1>
<div class="products index">
	<h2><?php __('Danh sách BĐS');?></h2>
	
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

			<th>Ngày còn lại</th>
			
			<th><?php __('Tình trạng');?></th>
			
			<th><?php __('Lượt truy cập');?></th>
			

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
		<td><?php if($product['Product']['for'] == 's') echo 'Bán'; elseif($product['Product']['for'] == 'm') echo 'Mua'; else echo 'Bán';?>&nbsp;</td>
		<td>
			<?php echo $product['Category']['name']; ?>
		</td>
		<!--
		<td>
			<?php echo $product['Product']['home_number'].", ".$product['Product']['street'].", ".$product['District']['name'].", " . $product['City']['name']; ?>
		</td>
		
		<td>
			<?php echo $product['Project']['name']; ?>
		</td>-->		
		
		
		<td><?php echo $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",")." " : ""; ?><?php echo $product['CurrencyPrice']['code'].$product['Product']['price_perm2']; ?>&nbsp;</td>
		
		<td><?php echo $product['Product']['days']; ?>&nbsp;</td>
		<td><?php
		
			if($product['Product']['published'] == 0)
			{
				$name = __('đang soạn', true);
			}
			if($product['Product']['published'] == 1)
			{
				$name = __('chờ duyệt', true);
			}
			else if($product['Product']['published'] == 2)
			{
				$name = __('đang hiển thị', true);
			}
			else if($product['Product']['published'] == 3)
			{
				$name = __('tắt hiển thị', true);
			}
			else if($product['Product']['published'] == -1)
			{
				$name = __('hết hạn', true);
			}
			else if($product['Product']['published'] == -2)
			{
				$name = __('không hợp lệ', true);
			}
			echo $name;
		
		?>&nbsp;</td>
		
		<td><?php echo $product['Product']['hit']; ?>&nbsp;</td>
		
		
		<td class="actions" style="text-align: right">			
			
			<?php //echo $product['Product']['published'] ? $this->Html->link(__('Làm mới tin', true), array('action' => 'publish', $product['Product']['id'])) : ''; ?>
			<?php
					if($product['Product']['published'] == 0)
					{
						echo $this->Html->link('Đăng tin', array('action' => 'publish', $product['Product']['id']));
						echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $product['Product']['id']));
						echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Bạn có chắc muốn xóa tin # %s?', true), $product['Product']['id']));
					}
					else if($product['Product']['published'] == 1)
					{
						echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $product['Product']['id']));
						echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Bạn có chắc muốn xóa tin # %s?', true), $product['Product']['id']));
					}
					else if($product['Product']['published'] == -1)
					{
						echo $product['Product']['published'] != 0 ? $this->Html->link(__('Làm mới tin', true), array('action' => 'renew', $product['Product']['id'])) : '';
						echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $product['Product']['id']));
						echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Bạn có chắc muốn xóa tin # %s?', true), $product['Product']['id']));
					}
					else if($product['Product']['published'] == 2 || $product['Product']['published'] == 3)
					{
						echo $product['Product']['published'] != 0 ? $this->Html->link(__('Làm mới tin', true), array('action' => 'renew', $product['Product']['id'])) : '';
						echo $this->Html->link('Bật/Tắt', array('action' => 'publish', $product['Product']['id']));
						echo $product['Product']['published'] != 0 ? $this->Html->link(__('Sửa', true), array('action' => 'unpublish', $product['Product']['id'])) : '';
						echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Bạn có chắc muốn xóa tin # %s?', true), $product['Product']['id']));
					}
					else if($product['Product']['published'] == -2)
					{
						echo $this->Html->link('Đăng tin', array('action' => 'publish', $product['Product']['id']));
						echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $product['Product']['id']));
						echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Bạn có chắc muốn xóa tin # %s?', true), $product['Product']['id']));
					}
				?>
			<?php //echo $product['Product']['published'] != 0 ? $this->Html->link(__('Làm mới tin', true), array('action' => 'renew', $product['Product']['id'])) : ''; ?>
			<?php //echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php //echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
		<!--<td>
			<?php if(!isset($product['NewOrder']) && $product['Product']['published'] == 0) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'orders', 'action'=>'add', 'manager'=>true, $product['Product']['id'])) ?>">Đăng sản phẩm</a>
			<?php } else if(isset($product['NewOrder'])) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'orders', 'action'=>'checkout', 'manager'=>true, $product['NewOrder']['id'])) ?>">Thanh toán</a>
			<?php } else { ?>
				Nâng cấp sản phẩm (đang phát triển ...)
			<?php } ?>
		</td>-->
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
	<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
	</div>
</div>