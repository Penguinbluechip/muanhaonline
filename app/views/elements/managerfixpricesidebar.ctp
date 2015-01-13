<?php $count = $this->requestAction('users/getAdminFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Thành viên'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'manager'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<li<?php if(isset($status)) if($status == 'NEW_PRODUCT') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lưu trữ - chưa thanh toán ('.$count["fixprice_order_notpaid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','NEW_PRODUCT');$('#bds_published').submit()")); ?></li>			
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Quản lý nhóm CTV'); ?></h3>
	<ul>
		<li <?php if(($this->params['controller'] == 'expert_groups')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Nhóm CTV', true), array('controller' => 'expert_groups', 'action' => 'index', 'supervisor'=>true)); ?></li>
	</ul>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>