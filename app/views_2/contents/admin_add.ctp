<div class="contents form">
<?php echo $this->Form->create('Content');?>
	<fieldset>
		<legend><?php __('Admin Add Content'); ?></legend>
	<?php
		echo $this->Form->input('content_category_id');
		echo $this->Form->input('name');
		echo $this->Form->input('content', array('style'=>'width:100%;height:600px'));
		echo $this->Form->input('create_date', array());
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contents', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Content Categories', true), array('controller' => 'content_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content Category', true), array('controller' => 'content_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>