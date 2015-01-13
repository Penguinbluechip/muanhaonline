<div class="fixpriceOrders form">
<?php echo $this->Form->create('FixpriceOrder');?>
	<fieldset>
		<legend><?php __('Bàn giao yêu cầu cho CTV'); ?></legend>
		
		<div class="input select">
			<label for="FixpriceOrderProduct">Nội dung thẩm định:</label>
			<?php echo $this->Html->link($this->data['Product']['name'], array('controller' => 'fixprice_orders', 'action' => 'view', $this->data['FixpriceOrder']['id']), array('target'=>'_blank')); ?>
		</div>
		<div class="input select">
			<label for="FixpriceOrderProduct">Nhóm CTV:</label>
			<strong><?php echo $this->data['ExpertGroup']['name']; ?></strong>
		</div>	
		
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('assigner_id', array('type' => 'radio', 'legend' => 'Thành viên:'));
		echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghi chú'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Bàn giao', true));?>
</div>
<div class="actions">
	<?php echo $this->element('expertsidebar'); ?>
</div>