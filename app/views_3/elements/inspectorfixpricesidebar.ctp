<?php $count = $this->requestAction('users/getInspectorFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Kiểm soát viên thẩm định'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'inspector'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			
			<li<?php if(isset($status)) if($status == 'EXPERT_PENDING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi KSV duyệt ('.$count["fixprice_order_expert_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_PENDING');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'INSPECTOR_CONFIRM_WAIT') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi KSV tiếp nhận ('.$count["fixprice_order_inspector_confirm_wait"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','INSPECTOR_CONFIRM_WAIT');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'INSPECTOR_CONFIRMED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Thẩm định đã nhận ('.$count["fixprice_order_inspector_confirmed"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','INSPECTOR_CONFIRMED');$('#bds_published').submit()")); ?></li>

		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>