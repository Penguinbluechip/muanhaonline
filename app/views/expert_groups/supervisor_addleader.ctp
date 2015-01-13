
<div class="expertGroups form">
<?php echo $this->Form->create('ExpertGroup');?>
	<fieldset>
		<legend><?php __('Thêm trưởng nhóm CTV'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('expert_id', array('label'=>'Trưởng nhóm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Lưu', true));?>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Danh sách nhóm', true), array('action' => 'index'));?></li>
		
	</ul>
	
	<?php echo $this->element('supervisorfixpricesidebar'); ?>
</div>