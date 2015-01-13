<div class="companyCategories form">
<?php echo $this->Form->create('CompanyCategory');?>
	<fieldset>
		<legend><?php __('Admin Add Company Category'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Company Categories', true), array('action' => 'index'));?></li>
	</ul>
</div>