<div class="cities form">
<?php echo $this->Form->create('City');?>
	<fieldset>
		<legend><?php __('Admin Edit City'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('ordering');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('City.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('City.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>