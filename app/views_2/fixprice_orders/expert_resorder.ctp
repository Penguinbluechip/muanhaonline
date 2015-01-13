<div class="fixpriceOrders form">
<?php echo $this->Form->create('FixpriceOrder');?>
	<fieldset>
		<legend><?php __('Chọn nhóm đăng ký yêu cầu thẩm định'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('expert_group_id', array('label'=>'Chọn nhóm'));
		//echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghi chú'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Trở lại trang chính', true), array('action' => 'index'));?></li>
		
	</ul>
</div>