<div class="settings form">
<?php echo $this->Form->create('Setting');?>
	<fieldset>
		<legend><?php __('Admin Edit Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->hidden('alias');
		echo $this->Form->input('value');
		echo $this->Form->hidden('modified_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		
		<li><?php echo $this->Html->link(__('List Settings', true), array('action' => 'index'));?></li>
	</ul>
</div>