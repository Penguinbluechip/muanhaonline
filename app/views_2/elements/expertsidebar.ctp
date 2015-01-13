<?php $count = $this->requestAction('users/getExpertSideBarCount'); ?>

	<?php if($count['isLeader']) { ?>
		<h3 style="margin-top: 20px"><?php __('Quản lý nhóm'); ?></h3>
		<h4>Yêu cầu thẩm định</h4>
		<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'expert'=>true)); ?>" method="POST" id="bds_published">
			<input type="hidden" name="filter_status" id="filter_status" value="" />
			<ul>
				<li<?php if(isset($status)) if($status == 'PAID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Tự do ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','PAID');$('#bds_published').submit()")); ?></li>
				<li<?php if(isset($status)) if($status == 'REGISTERED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã đăng ký/Chưa bàn giao ('.$count["fixprice_order_registered"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','REGISTERED');$('#bds_published').submit()")); ?></li>
				
				<!--<li<?php if(isset($status)) if($status == 'ASSIGNED_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã bàn giao ('.$count["fixprice_order_assigned_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','ASSIGNED_LEAD');$('#bds_published').submit()")); ?></li>
				<li<?php if(isset($status)) if($status == 'EXPERT_CONFIRMED_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã tiếp nhận ('.$count["fixprice_order_confirmed_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_CONFIRMED_LEAD');$('#bds_published').submit()")); ?></li>-->
				<li<?php if(isset($status)) if($status == 'EXPERT_REJECTED_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã từ chối ('.$count["fixprice_order_rejected_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_REJECTED_LEAD');$('#bds_published').submit()")); ?></li>
				
				
				
				<li<?php if(isset($status)) if($status == 'WORKING_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang thực hiện ('.$count["fixprice_order_working_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','WORKING_LEAD');$('#bds_published').submit()")); ?></li>
				
				<li<?php if(isset($status)) if($status == 'FINISHED_ALL_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã hoàn thành ('.$count["fixprice_order_finished_all_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FINISHED_ALL_LEAD');$('#bds_published').submit()")); ?></li>
				<li<?php if(isset($status)) if($status == 'FAILED_LEAD') echo ' class="active"' ?>><?php echo $this->Html->link(__('Không đạt ('.$count["fixprice_order_failed_lead"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FAILED_LEAD');$('#bds_published').submit()")); ?></li>
			</ul>
		</form>
	<?php } ?>


	<h3 style="margin-top: 20px"><?php __('Cộng Tác Viên'); ?></h3>
	<h4>Yêu cầu thẩm định</h4>
	<form action="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action' => 'index', 'expert'=>true)); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_status" id="filter_status" value="" />
		<ul>
			<li<?php if(isset($status)) if($status == 'PAID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Tự do ('.$count["fixprice_order_new"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','PAID');$('#bds_published').submit()")); ?></li>
			
			<li<?php if(isset($status)) if($status == 'ASSIGNED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Được bàn giao ('.$count["fixprice_order_assigned"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','ASSIGNED');$('#bds_published').submit()")); ?></li>
			
			<li<?php if(isset($status)) if($status == 'WORKING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang thực hiện ('.$count["fixprice_order_working"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','WORKING');$('#bds_published').submit()")); ?></li>
			
			
			
			
			<!--<li<?php if(isset($status)) if($status == 'EXPERT_CONFIRMED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã tiếp nhận ('.$count["fixprice_order_confirmed"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_CONFIRMED');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'EXPERT_REJECTED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã từ chối ('.$count["fixprice_order_rejected"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_REJECTED');$('#bds_published').submit()")); ?></li>
			
			
			
			
                        <li<?php if(isset($status)) if($status == 'EXPERT_PENDING') echo ' class="active"' ?>><?php echo $this->Html->link(__('Chờ duyệt ('.$count["fixprice_order_expert_pending"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','EXPERT_PENDING');$('#bds_published').submit()")); ?></li>-->
			
			
			
			
			<li<?php if(isset($status)) if($status == 'FINISHED_ALL') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã hòan thành ('.$count["fixprice_order_finished_all"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FINISHED_ALL');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == 'FAILED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Không đạt ('.$count["fixprice_order_failed"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FAILED');$('#bds_published').submit()")); ?></li>
			
			
			
			<!--<li<?php if(isset($status)) if($status == 'VALID') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã duyệt ('.$count["fixprice_order_valid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','VALID');$('#bds_published').submit()")); ?></li>
			
			<li<?php if(isset($status)) if($status == 'FINISHED_RATED') echo ' class="active"' ?>><?php echo $this->Html->link(__('Hoàn tất ('.$count["fixprice_order_rated"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','FINISHED_RATED');$('#bds_published').submit()")); ?></li>-->
			
			<!--<li<?php if(isset($status)) if($status == '5') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã duyệt ('.$count["fixprice_order_valid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','5');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($status)) if($status == '-1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Lỗi ('.$count["fixprice_order_invalid"].")", true), "#none", array('onclick'=>"$('#filter_status').attr('value','-1');$('#bds_published').submit()")); ?></li>-->
		</ul>
	</form>
	
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Điểm số: <strong>0</strong></p>
	</div>