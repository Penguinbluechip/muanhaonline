<div class="fixpriceAnswers form">
<?php echo $this->Form->create('FixpriceAnswer');?>
	<fieldset>
		<legend><?php __('Expert Edit Fixprice Answer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fixprice_order_id');
		echo $this->Form->input('price_total');
		echo $this->Form->input('price_unit');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Lưu', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FixpriceAnswer.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FixpriceAnswer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Answers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>