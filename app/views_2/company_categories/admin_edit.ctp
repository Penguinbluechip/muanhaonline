<div class="companyCategories form">
<?php echo $this->Form->create('CompanyCategory');?>
	<fieldset>
		<legend><?php __('Admin Edit Company Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CompanyCategory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CompanyCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Company Categories', true), array('action' => 'index'));?></li>
	</ul>
</div>