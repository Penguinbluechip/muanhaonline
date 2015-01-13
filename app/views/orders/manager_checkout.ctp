<div class="orders form">
<?php echo $this->Form->create('Order');?>

	
	<h2><?php  __('Thanh toán hóa đơn');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mã hóa đơn'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tên người dùng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sản phẩm'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Loại thanh toán'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['OrderType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Giá'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['OrderType']['price']; ?> VNĐ
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tạo ngày'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['date']; ?>
			&nbsp;
		</dd>
	</dl>



	
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('code');
		//echo $this->Form->input('user_id', array('value'=>$user["id"], 'type'=>'hidden'));
		//echo $this->Form->input('product_id', array('value'=>$id, 'type'=>'hidden'));
		//echo $this->Form->input('price');
		//echo $this->Form->input('type');
		//echo $this->Form->input('date');
		//echo $this->Form->input('order_type_id');
	?>

<?php echo $this->Form->end();?>
<div class="actions" style="width:280px">
	<ul>	
		<li><a href="<?php echo $checkout_link;?>">Thanh toán bằng qua cổng NganLuong.com</a></li>		
	</ul>
</div>

</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>

		
		<li><?php echo $this->Html->link(__('Danh sách BĐS', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		
	</ul>
</div>