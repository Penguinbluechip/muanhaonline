<?php $count = $this->requestAction('users/getSupervisorFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Cộng Tác Viên'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'supervisor'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<!--<li<?php if(isset($status)) if($status == '-1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định đã hoàn thành ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','-1');$('#bds_published').submit()")); ?></li>-->
			<!--<li<?php if(isset($status)) if($status == '-1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định lỗi ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','-1');$('#bds_published').submit()")); ?></li>-->
			<!--<li<?php if(isset($status)) if($status == '4') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định đợi duyệt ('.$count["fixprice_order_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','4');$('#bds_published').submit()")); ?></li>-->
			
			<li<?php if(isset($status)) if($status == 'PAID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đăng ký tự do ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','PAID');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'PRIVATE_REGISTER') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi nhóm đăng ký ('.$count["fixprice_order_private_register"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','PRIVATE_REGISTER');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'REGISTERED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã đăng ký nhóm ('.$count["fixprice_order_registered"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','REGISTERED');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'ASSIGNED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã bàn giao ('.$count["fixprice_order_assigned"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','ASSIGNED');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'EXPERT_CONFIRMED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Nhận thẩm định ('.$count["fixprice_order_confirmed"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_CONFIRMED');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'EXPERT_REJECTED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Từ chối thẩm định ('.$count["fixprice_order_rejected"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_REJECTED');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'EXPERT_PENDING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi KSV duyệt ('.$count["fixprice_order_expert_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_PENDING');$('#bds_published').submit()")); ?></li>
			
			<li<?php if(isset($status)) if($status == 'INVALID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Không đạt ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','INVALID');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'FINISHED_RATED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Hoàn tất ('.$count["fixprice_order_rated"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FINISHED_RATED');$('#bds_published').submit()")); ?></li>
			
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