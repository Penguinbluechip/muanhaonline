<?php $count = $this->requestAction('users/getAdminFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Yêu cầu thẩm định'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'admin'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<!--<li<?php if(isset($status)) if($status == '4') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định đợi duyệt ('.$count["fixprice_order_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','4');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == '3') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã bàn giao ('.$count["fixprice_order_assigned"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','3');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == '2') echo ' class="active"' ?>><?php echo $this->Html->link(__('Chưa bàn giao CTV ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','2');$('#bds_published').submit()")); ?></li>
                        <li<?php if(isset($status)) if($status == '-1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định lỗi ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','-1');$('#bds_published').submit()")); ?></li>-->
			
			<li<?php if(isset($status)) if($status == 'EXPERT_PENDING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi KSV duyệt ('.$count["fixprice_order_expert_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_PENDING');$('#bds_published').submit()")); ?></li>			
			<li<?php if(isset($status)) if($status == 'NEW_PRODUCT') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lưu trữ - chưa thanh toán ('.$count["fixprice_order_notpaid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','NEW_PRODUCT');$('#bds_published').submit()")); ?></li>
			
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>