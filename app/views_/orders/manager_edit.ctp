<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php __('Manager Edit Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('order_type_id');
		echo $this->Form->input('price');
		echo $this->Form->input('type');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Order.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Order.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types', true), array('controller' => 'order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type', true), array('controller' => 'order_types', 'action' => 'add')); ?> </li>
	</ul>
</div>