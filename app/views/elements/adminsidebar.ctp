<?php $count = $this->requestAction('products/getAdminSideBarCount'); ?>        
        <h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Đăng tin bất động sản', true), array('controller'=>'products', 'action' => 'add')); ?></li>		
	</ul>
	<h3 style="margin-top: 20px"><?php __('Bất động sản'); ?></h3>
	<form action="<?php echo $this->Html->url(array('controller'=>'products', 'action' => 'index')); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_published" id="filter_published" value="" />
		<input type="hidden" name="filter_pay_status" id="filter_pay_status" value="" />
		<ul>
			<li<?php if(isset($published)) if($published == 'all' || $published == '') echo ' class="active"' ?>><?php echo $this->Html->link(__('Tất cả', true), "#none", array('onclick'=>"$('#filter_published').attr('value','all');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published)) if($published == '2' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang hiển thị ('.$count[2].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','2');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published)) if($published == '3' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Tắt hiển thị ('.$count[3].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','3');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published)) if($published == '-1' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Hết hạn hiển thị ('.$count[-1].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','-1');$('#bds_published').submit()")); ?>
			<li<?php if(isset($published)) if($published == '0' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang soạn ('.$count[0].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','0');$('#bds_published').submit()")); ?></li></li>
			<li<?php if(isset($published)) if($published == '1' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang chờ duyệt ('.$count[1].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','1');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published)) if($published == '-2' && $pay_status != '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Không hợp lệ ('.$count[-2].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','-2');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published) && isset($pay_status)) if($published == '2' && $pay_status == '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đã trả phí ('.$count[4].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','2');$('#filter_pay_status').attr('value','1');$('#bds_published').submit()")); ?></li>
			<li<?php if(isset($published) && isset($pay_status)) if($published == '0' && $pay_status == '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Chưa trả phí ('.$count[5].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','0');$('#filter_pay_status').attr('value','1');$('#bds_published').submit()")); ?></li>
                        
		</ul>
	</form>
	<!--<h3 style="margin-top: 20px"><?php __('Lưu trữ'); ?></h3>
	<ul>
		<li <?php if(($this->params['controller'] == 'favorites')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Tin BĐS đã lưu ('.$count['favorite'].')', true), array('controller'=>'favorites'), array()); ?></li>		
	</ul>
	<h3 style="margin-top: 20px"><?php __('Tài khoản'); ?></h3>
	<ul>
		<li <?php if(($this->params['controller'] == 'user_profiles')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Sửa thông tin cá nhân', true), array('controller'=>'user_profiles', 'action'=>'editprofile'), array()); ?></li>
		<li <?php if(($this->params['controller'] == 'users')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Đổi mật khẩu', true), array('controller'=>'users', 'action'=>'changepassword'), array()); ?></li>			
	</ul>-->
	<h3 style="margin-top: 20px"><?php __('Thống kê'); ?></h3>
	<div>
		<p>Tổng số tài sản: <strong><?php echo $count["all"] ?></strong></p>
		<p>Đang hiển thị: <strong><?php echo $count[2] ?></strong></p>
		<p>Tổng lượt xem: <strong><?php echo $count["views"][0][0]["count"] ?></strong></p>
		<p>Cần bán: <strong><?php echo $count["sale"] ?></strong></p>
		<p>Cần cho thuê: <strong><?php echo $count["lease"] ?></strong></p>
		<p>Cần mua: <strong><?php echo $count["need_sale"] ?></strong></p>
		<p>Cần thuê: <strong><?php echo $count["need_lease"] ?></strong></p>
                <p>Chưa thanh toán: <strong><?php echo $count[5] ?></strong></p>
	</div>