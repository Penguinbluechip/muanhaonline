<div class="occupantTypes form">
<?php echo $this->Form->create('OccupantType');?>
	<fieldset>
		<legend><?php __('Admin Edit Occupant Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('OccupantType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('OccupantType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Occupant Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>