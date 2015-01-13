<?php $count = $this->requestAction('users/getFixpriceSideBarCount'); ?>

	<h3 style="margin-top: 20px"><?php __('Yêu cầu thẩm định'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'manager'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<li><a target="_blank" href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'add_step1', 'manager'=>false)); ?>">Đăng yêu cầu thẩm định BĐS</a></li>
			<li<?php if(isset($status)) if($status == '2') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đợi thẩm định ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','2');$('#bds_published').submit()")); ?></li>
                        <li<?php if(isset($status)) if($status == '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lưu trữ - chưa thanh toán ('.$count["fixprice_order_notpaid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','1');$('#bds_published').submit()")); ?></li>
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>