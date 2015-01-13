<div class="fixpriceOrderStates form">
<?php echo $this->Form->create('FixpriceOrderState');?>
	<fieldset>
		<legend><?php __('Admin Add Fixprice Order State'); ?></legend>
	<?php
		echo $this->Form->input('alias');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fixprice Order States', true), array('action' => 'index'));?></li>
	</ul>
</div>