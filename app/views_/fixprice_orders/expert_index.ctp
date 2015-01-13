<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định BĐS');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Mã</th>			
			<th>Sản phẩm</th>
			<th>Loại thẩm định</th>
			<th>Loại dịch vụ</th>			
			<th>Ngày tạo</th>
			<th>Trạng thái</th>
			<th>Hạn còn lại</th>
			<th class="actions"><?php __('Chức năng');?></th>
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
			<?php echo $fixpriceOrder['Product']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['FixpriceType']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['FixpriceService']['name']; ?>
		</td>
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td>
			<?php //echo $fixpriceOrder['FixpriceOrder']['status'];
				switch($fixpriceOrder['FixpriceOrder']['status']){
					case 1:
						echo "chưa thanh toán";
						break;
					case 3:
						echo "đang xử lý";
						break;
					case -1:
						echo "thẩm định lại";
						break;
				}
			?>		
		&nbsp;</td>
		<td>
			<?php
				if(isset($fixpriceOrder['remain_hours']))
				{
					if($fixpriceOrder['remain_hours'] > 0)
						echo $fixpriceOrder['remain_hours'].' tiếng';
					else
						echo 'hết hạn';
				}
			
			?>
		
		
		&nbsp;</td>
		<td class="actions">
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrder']['status'] == 3 || $fixpriceOrder['FixpriceOrder']['status'] == -1) { ?>
				<?php echo $this->Html->link(__('Thẩm định', true), array('controller'=>'fixprice_answers','action' => 'add', $fixpriceOrder['FixpriceOrder']['id'])); ?>
				<?php echo $this->Html->link(__('Đăng thẩm định', true), array('controller'=>'fixprice_orders','action' => 'postanswer', $fixpriceOrder['FixpriceOrder']['id'])); ?>
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
	<?php echo $this->element('expertsidebar'); ?>
	<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
	</div>
</div>