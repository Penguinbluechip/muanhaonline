<h1 class="page-title">Dịch vụ chính >> Thẩm định giá BĐS</h1>
<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định BĐS');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>STT</th>
			<th>Sản phẩm</th>
			<th>Loại thẩm định</th>
			<th>Loại dịch vụ</th>			
			<th>Ngày tạo</th>
			<th>Trạng thái</th>
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceOrders as $stt => $fixpriceOrder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $stt+1; ?>&nbsp;</td>						
		<td>
			<?php echo $this->Html->link($fixpriceOrder['Product']['name'], array('controller' => 'products', 'action' => 'view', $fixpriceOrder['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceService']['name'], array('controller' => 'fixprice_services', 'action' => 'view', $fixpriceOrder['FixpriceService']['id'])); ?>
		</td>
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td>
			<?php //echo $fixpriceOrder['FixpriceOrder']['status'];
				switch($fixpriceOrder['FixpriceOrder']['status']){
					case 1:
						echo "chưa thanh toán";
						break;
					case 2:
						echo "đang xử lý";
						break;
				}
			?>		
		&nbsp;</td>
		<td class="actions">			
			<?php if($fixpriceOrder['FixpriceOrder']['status'] == 1) { ?>
				<a href="<?php echo $fixpriceOrder['FixpriceOrder']['checkout_link'] ?>" target="_blank">Thanh toán</a>
			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page%/%pages%, hiển thị %current% trên %count% yêu cầu', true)
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
	<?php echo $this->element('fixpricesidebar'); ?>
	<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
	</div>
</div>