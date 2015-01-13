<div class="utilities form">
<?php echo $this->Form->create('Utility');?>
	<fieldset>
		<legend><?php __('Admin Add Utility'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Utilities', true), array('action' => 'index'));?></li>
	</ul>
</div>