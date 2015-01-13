<?php $count = $this->requestAction('users/getUserFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Yêu cầu thẩm định'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'user'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<li<?php if(isset($status)) if($status == 'PENDING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi thẩm định ('.$count["fixprice_order_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','PENDING');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'VALID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Có kết quả ('.$count["fixprice_order_valid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','VALID');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'FINISHED_RATED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Hoàn tất ('.$count["fixprice_order_rated"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FINISHED_RATED');$('#bds_published').submit()")); ?></li>
                        <li<?php if(isset($status)) if($status == 'NEW_PRODUCT') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lưu trữ - chưa thanh toán ('.$count["fixprice_order_notpaid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','NEW_PRODUCT');$('#bds_published').submit()")); ?></li>
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>