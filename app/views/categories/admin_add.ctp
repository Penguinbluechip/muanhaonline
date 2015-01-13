<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
		<legend><?php __('Admin Add Category'); ?></legend>
	<?php
		echo $this->Form->input('type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('decsription');
		echo $this->Form->input('Utility');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Types', true), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type', true), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilities', true), array('controller' => 'utilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utility', true), array('controller' => 'utilities', 'action' => 'add')); ?> </li>
	</ul>
</div>