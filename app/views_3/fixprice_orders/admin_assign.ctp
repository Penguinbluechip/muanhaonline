<div class="fixpriceOrders form">
<?php echo $this->Form->create('FixpriceOrder');?>
	<fieldset>
		<legend><?php __('Admin Edit Fixprice Order'); ?></legend>
		
		<div class="input select">
			<label for="FixpriceOrderProduct">Sản phẩm:</label>
			<?php echo $this->Html->link($this->data['Product']['name'], array('controller' => 'products', 'action' => 'view', $this->data['Product']['id'])); ?>
		</div>
		
		<div class="input select">
			<label for="FixpriceOrderCustomer">Khách hàng:</label>
			<?php echo $this->Html->link($this->data['FixpriceCustomer']['name'], array('controller' => 'fixprice_customers', 'action' => 'view', $this->data['FixpriceCustomer']['id'])); ?>
		</div>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('fixprice_customer_id');
		//echo $this->Form->input('product_id');
		echo $this->Form->input('expert_id', array('label' => 'Cộng tác viên:'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FixpriceOrder.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FixpriceOrder.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fixprice Customers', true), array('controller' => 'fixprice_customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Customer', true), array('controller' => 'fixprice_customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Types', true), array('controller' => 'fixprice_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Type', true), array('controller' => 'fixprice_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Services', true), array('controller' => 'fixprice_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Service', true), array('controller' => 'fixprice_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Payments', true), array('controller' => 'fixprice_payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Payment', true), array('controller' => 'fixprice_payments', 'action' => 'add')); ?> </li>
	</ul>
</div>