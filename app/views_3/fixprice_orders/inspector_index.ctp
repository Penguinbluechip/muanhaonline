<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Mã</th>
			<!--<th><?php echo $this->Paginator->sort('fixprice_customer_id');?></th>-->
			<th>Người yêu cầu</th>
			<th>Nhóm CTV</th>
			<th>CTV đảm trách</th>
			<th>Yêu cầu</th>
			<th>Loại dịch vụ</th>
			<!--<th><?php echo $this->Paginator->sort('fixprice_service_id');?></th>-->
			
			<th>Ngày tạo</th>
			<th>Số lần thẩm định lại</th>
			<th>Hạn còn lại</th>
			<!--<th style="display: none"><?php echo $this->Paginator->sort('status');?></th>-->
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
		<!--<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceCustomer']['name'], array('controller' => 'fixprice_customers', 'action' => 'view', $fixpriceOrder['FixpriceCustomer']['id'])); ?>
		</td>-->
		<td>
			<?php echo $fixpriceOrder['User']['username']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['ExpertGroup']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['Expert']['username']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['Product']['name']; ?>
		</td>
		<!--<td style="display: none">
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
		</td>-->
		<td>
			<?php echo $fixpriceOrder['FixpriceService']['name']; ?>
		</td>
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td><?php echo $fixpriceOrder['FixpriceOrder']['countinvalid']; ?>&nbsp;</td>
		<td><?php if(isset($fixpriceOrder['remain_hours'])) echo $fixpriceOrder['remain_hours']; ?>&nbsp;</td>
		<td style="display: none"><?php echo $fixpriceOrder['FixpriceOrder']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php if($fixpriceOrder['FixpriceOrderState']['alias'] == 'EXPERT_PENDING') { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["FixpriceCustomer"]["email"], 'inspector'=>true), false); ?>" target="_blank">Xem</a>				
				<?php echo $this->Html->link(__('Duyệt', true), '#valid_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#valid_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>
				<?php echo $this->Html->link(__('Không duyệt', true), '#invalid_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#invalid_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>
				<?php echo $this->Html->link(__('Nhận thẩm định', true), '#register_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#register_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>
			<?php } ?>
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrderState']['alias'] == 'INSPECTOR_CONFIRMED') { ?>
				<?php echo $this->Html->link(__('Thẩm định', true), array('controller'=>'fixprice_answers','action' => 'add', $fixpriceOrder['FixpriceOrder']['id'])); ?>
				<?php echo $this->Html->link(__('Đăng thẩm định', true), array('controller'=>'fixprice_orders','action' => 'publish', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } ?>
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrderState']['alias'] == 'INSPECTOR_CONFIRM_WAIT') { ?>
				<?php echo $this->Html->link(__('Nhận thẩm định', true), array('action' => 'inspector_confirm', $fixpriceOrder['FixpriceOrder']['id'])); ?>				
			<?php } ?>
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
<div class="actions expert_leftbar">
	<?php echo $this->element('inspectorfixpricesidebar'); ?>
	
</div>

<div id="valid_box" style="display: none; padding: 10px;">
	<label><strong>Xác nhận thẩm định đạt yêu cầu. Thông tin cho khách hàng !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'valid'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>

<div id="invalid_box" style="display: none; padding: 10px;">
	<label><strong>Thẩm định không đạt yêu cầu. Yêu cầu CTV thẩm định lại !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'invalid'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>

<div id="register_box" style="display: none; padding: 10px;">
	<label><strong>Nhận yêu cầu thẩm định !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'register'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>