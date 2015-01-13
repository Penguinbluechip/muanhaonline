<div class="userImages form">
<?php echo $this->Form->create('UserImage');?>
	<fieldset>
		<legend><?php __('Admin Edit User Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_profile_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('type');
		echo $this->Form->input('filename');
		echo $this->Form->input('dir');
		echo $this->Form->input('mimetype');
		echo $this->Form->input('filesize');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('UserImage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('UserImage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List User Profiles', true), array('controller' => 'user_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Profile', true), array('controller' => 'user_profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>