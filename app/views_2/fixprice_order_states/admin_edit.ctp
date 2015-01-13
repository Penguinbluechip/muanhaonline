<div class="fixpriceOrderStates form">
<?php echo $this->Form->create('FixpriceOrderState');?>
	<fieldset>
		<legend><?php __('Admin Edit Fixprice Order State'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('alias');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FixpriceOrderState.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FixpriceOrderState.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Order States', true), array('action' => 'index'));?></li>
	</ul>
</div>