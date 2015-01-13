<div class="districts form">
<?php echo $this->Form->create('District');?>
	<fieldset>
		<legend><?php __('Admin Edit District'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('District.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('District.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>