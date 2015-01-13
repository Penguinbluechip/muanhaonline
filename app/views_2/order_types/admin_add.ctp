<div class="orderTypes form">
<?php echo $this->Form->create('OrderType');?>
	<fieldset>
		<legend><?php __('Admin Add Order Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Order Types', true), array('action' => 'index'));?></li>
	</ul>
</div>