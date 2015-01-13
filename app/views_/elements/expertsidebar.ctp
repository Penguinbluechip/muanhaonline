<?php $count = $this->requestAction('users/getExpertSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Yêu cầu Thẩm định'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'expert'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<li<?php if(isset($status)) if($status == '3') echo ' class="active"' ?>><?php echo $this->Html->link(__('Mới ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','3');$('#bds_published').submit()")); ?></li>
                        <li<?php if(isset($status)) if($status == '4') echo ' class="active"' ?>><?php echo $this->Html->link(__('Chờ duyệt ('.$count["fixprice_order_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','4');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == '5') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã duyệt ('.$count["fixprice_order_valid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','5');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == '-1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lỗi ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','-1');$('#bds_published').submit()")); ?></li>
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>