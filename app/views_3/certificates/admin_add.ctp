<div class="certificates form">
<?php echo $this->Form->create('Certificate');?>
	<fieldset>
		<legend><?php __('Admin Add Certificate'); ?></legend>
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

		<li><?php echo $this->Html->link(__('List Certificates', true), array('action' => 'index'));?></li>
	</ul>
</div>