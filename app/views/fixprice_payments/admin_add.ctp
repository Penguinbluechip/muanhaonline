<div class="fixpricePayments form">
<?php echo $this->Form->create('FixpricePayment');?>
	<fieldset>
		<legend><?php __('Admin Add Fixprice Payment'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fixprice Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>