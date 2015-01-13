<div class="needTypes form">
<?php echo $this->Form->create('NeedType');?>
	<fieldset>
		<legend><?php __('Admin Add Need Type'); ?></legend>
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

		<li><?php echo $this->Html->link(__('List Need Types', true), array('action' => 'index'));?></li>
	</ul>
</div>