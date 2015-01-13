<div class="productImages form">
<?php echo $this->Form->create('ProductImage', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Admin Add Product Image'); ?></legend>
	<?php
		echo $this->Form->input('product_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('type');
		echo $this->Form->input('filename', array('type' => 'file'));
		echo $this->Form->input('dir', array('type' => 'hidden'));
		echo $this->Form->input('mimetype', array('type' => 'hidden'));
		echo $this->Form->input('filesize', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Product Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>