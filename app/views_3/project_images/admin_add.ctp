<div class="projectImages form">
<?php echo $this->Form->create('ProjectImage');?>
	<fieldset>
		<legend><?php __('Admin Add Project Image'); ?></legend>
	<?php
		echo $this->Form->input('project_id');
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

		<li><?php echo $this->Html->link(__('List Project Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>