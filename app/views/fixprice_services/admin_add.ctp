<div class="fixpriceServices form">
<?php echo $this->Form->create('FixpriceService');?>
	<fieldset>
		<legend><?php __('Admin Add Fixprice Service'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
		echo $this->Form->input('pay_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fixprice Services', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>