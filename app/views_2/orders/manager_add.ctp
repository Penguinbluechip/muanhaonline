<div class="orders form">
<?php echo $this->Form->create('Order');?>



	<fieldset>
		<legend><?php __('Thanh toán'); ?></legend>
	<?php
		//echo $this->Form->input('code');
		echo $this->Form->input('user_id', array('value'=>$user["id"], 'type'=>'hidden'));
		echo $this->Form->input('product_id', array('value'=>$id, 'type'=>'hidden'));
		//echo $this->Form->input('price');
		//echo $this->Form->input('type');
		//echo $this->Form->input('date');
		echo $this->Form->input('order_type_id', array('label'=>'Loại thanh toán'));
	?>
	
	
	
	</fieldset>
<?php echo $this->Form->end(__('Chọn', true));?>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Danh sách BĐS', true), array('controller' => 'products', 'action' => 'index')); ?> </li>		
	</ul>
</div>