<div class="contacts form">
<?php echo $this->Form->create('Contact');?>
	<fieldset>
		<legend><?php __('Admin Edit Contact'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('address');
		echo $this->Form->input('zip');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('longitude');
		echo $this->Form->input('latitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Contact.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Contact.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contacts', true), array('action' => 'index'));?></li>
	</ul>
</div>