<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $this->Html->charset(); ?>
	<title>
		MuaNhaonline.com.vn - Phần quản trị
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');
		echo $this->Html->css('prettyPhoto');
		echo $this->Html->css('jquery-ui-1.8.16.custom');
		echo $this->Html->css('fancybox/jquery.fancybox');
		
		echo $this->Html->script('jquery-1.6.4.min');
		echo $this->Html->script('jshashtable-2.1');
		echo $this->Html->script('jquery.numberformatter-1.2.2.min');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=false');
		echo $this->Html->script('jquery-ui-1.8.16.custom.min');
		echo $this->Html->script('custom');		
		echo $this->Html->script('tiny_mce/tiny_mce.js');
		echo $this->Html->script('fancybox/jquery.fancybox.js');

		echo $scripts_for_layout;
	?>
	
	<script type="text/javascript">

	jQuery(document).ready(function($) {
		$("#ProductPropertyArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductLotArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductAreaX").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductAreaY").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductAreaBack").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductPrice").keyup(function(){
			$(this).parseNumber({format:"#,###", locale:"us"});
			$(this).formatNumber({format:"#,###", locale:"us"});
		});
		$("#ProductCommission").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectLotArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectPropertyArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectAreaX").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectAreaY").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectFloors").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectBlockPerFloor").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		
		$("#ProjectLotArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectPropertyArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectAreaX").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectAreaY").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectPropertyPercent").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectFloors").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProductBuildArea").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		$("#ProjectBlockPerFloor").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		
		$("#gtable input").blur(function(){
			$(this).parseNumber({format:"###.00", locale:"us"});
			$(this).formatNumber({format:"###.00", locale:"us"});
		});
		
		$("#NeedPriceFrom").keyup(function(){
			$(this).parseNumber({format:"##,###", locale:"us"});
			$(this).formatNumber({format:"##,###", locale:"us"});
		});
		$("#NeedPriceTo").keyup(function(){
			$(this).parseNumber({format:"##,###", locale:"us"});
			$(this).formatNumber({format:"##,###", locale:"us"});
		});
		$("#FixpriceAnswerPriceTotal").keyup(function(){
			$(this).parseNumber({format:"##,###", locale:"us"});
			$(this).formatNumber({format:"##,###", locale:"us"});
		});
		$("#FixpriceAnswerPriceUnit").keyup(function(){
			$(this).parseNumber({format:"##,###", locale:"us"});
			$(this).formatNumber({format:"##,###", locale:"us"});
		});
		
		$("a[rel^='prettyPhoto']").prettyPhoto();
		
		// Tabs
		$('#tabs').tabs();
		
		tinyMCE.init({
			mode : "exact",
			elements : "data[Product][description]",
			theme : "advanced",   //(n.b. no trailing comma, this will be critical as you experiment later)
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left"

		});
		
		$(".fancybox_link").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,

			autoSize	: true,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});

	});

	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1 style="float:left">
				<?php if (!empty($user)) {
					if($group['Group']['id'] == 2)
					{
						 echo "TRANG QUẢN TRỊ";
					}
					else if($group['Group']['id'] == 3)
					{
						 echo "PHẦN QUẢN TRỊ DÀNH CHO THÀNH VIÊN";
					}
					else if($group['Group']['id'] == 4)
					{
						echo "PHẦN QUẢN TRỊ DÀNH CHO ".$user['username'];
					}
					else if($group['Group']['id'] == 5)
					{
						 echo "PHẦN QUẢN TRỊ DÀNH CHO KIỂM SOÁT VIÊN";
					}
					else if($group['Group']['id'] == 6)
					{
						 echo "PHẦN QUẢN TRỊ DÀNH CHO KIỂM SOÁT VIÊN";
					}
				}?>				
				<?php //echo $this->Html->link(__('PHẦN QUẢN TRỊ', true), ''); ?>
			</h1>
			<div style="float:right">
				<?php if (!empty($user)) { ?>
					Chào, <?php echo $user['username']; ?>!
					  <?php
					  echo $this->Html->link('Đăng xuất', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'users', 'action'=>'logout'));
					} else {
					  echo $this->Html->link('Đăng nhập', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'users', 'action'=>'login'));
					}
				?> -
				<?php
					echo $this->Html->link('Về trang chủ', array('admin'=>false, 'controller'=>'home', 'action'=>'index'), array('target'=>'_blank'));
				?>
			</div>
		</div>		
		<div id="content">	
			
			<div id="main_nav" style="clear:both;float:left;margin-bottom:20px">
				
				
				<?php if (!empty($user) && $group["Group"]["id"] == 1) { ?>
					<div class="" style="float:left">
						<h3><?php __('Elements'); ?></h3>
						<ul>						
							<li><?php echo $this->Html->link(__('Cities', true), array('controller' => 'cities', 'action' => 'index', 'admin'=>true)); ?>
								<ul>
									<li><?php echo $this->Html->link(__('Districts', true), array('controller' => 'districts','action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Wards', true), array('controller' => 'wards','action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Auto Add Wards', true), array('controller' => 'wards','action' => 'auto_add', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Streets', true), array('controller' => 'streets','action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Auto Add Streets', true), array('controller' => 'streets','action' => 'auto_add', 'admin'=>true)); ?></li>
								</ul>
							</li>
							<li><?php echo $this->Html->link(__('Companies', true), array('controller' => 'companies', 'action' => 'index', 'admin'=>true)); ?>
								<ul><li><?php echo $this->Html->link(__('Categories', true), array('controller' => 'company_categories','action' => 'index', 'admin'=>true)); ?></li></ul>
							</li>
							<li><?php echo $this->Html->link(__('Types', true), array('controller' => 'types', 'action' => 'index', 'admin'=>true)); ?>
								<ul><li><?php echo $this->Html->link(__('Categories', true), array('controller' => 'categories','action' => 'index', 'admin'=>true)); ?></li></ul>
							</li>
							<li><?php echo $this->Html->link(__('Utilites', true), array('controller' => 'utilities', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Occupant Types', true), array('controller' => 'occupant_types', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Certificates', true), array('controller' => 'certificates', 'action' => 'index', 'admin'=>true)); ?></li>
							
							<li><?php echo $this->Html->link(__('Currencies', true), array('controller' => 'currencies', 'action' => 'index', 'admin'=>true)); ?></li>
							
							<li><?php echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index', 'admin'=>true)); ?></li>
							
							<li><?php echo $this->Html->link(__('Contents', true), array('controller' => 'contents', 'action' => 'index', 'admin'=>true)); ?>
								<ul><li><?php echo $this->Html->link(__('Categories', true), array('controller' => 'content_categories','action' => 'index', 'admin'=>true)); ?></li></ul>
							</li>
							
							<li><?php echo $this->Html->link(__('Contacts', true), array('controller' => 'contacts', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Order Types', true), array('controller' => 'order_types', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Need Types', true), array('controller' => 'need_types', 'action' => 'index', 'admin'=>true)); ?>
								<ul><li><?php echo $this->Html->link(__('Needs', true), array('controller' => 'needs', 'action' => 'index', 'admin'=>true)); ?></li></ul>
							</li>
							<li><?php echo $this->Html->link(__('Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'index', 'admin'=>true)); ?>
								<ul>
									<li><?php echo $this->Html->link(__('Payments', true), array('controller' => 'fixprice_payments', 'action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Types', true), array('controller' => 'fixprice_types', 'action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Services', true), array('controller' => 'fixprice_services', 'action' => 'index', 'admin'=>true)); ?></li>
									<li><?php echo $this->Html->link(__('Rates', true), array('controller' => 'fixprice_rates', 'action' => 'index', 'admin'=>true)); ?></li>
								</ul>
							</li>
							<li><?php echo $this->Html->link(__('Fixprice Order States', true), array('controller' => 'fixprice_order_states', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Expert Groups', true), array('controller' => 'expert_groups', 'action' => 'index', 'admin'=>true)); ?></li>
							<li><?php echo $this->Html->link(__('Settings', true), array('controller' => 'settings', 'action' => 'index', 'admin'=>true)); ?></li>
						</ul>
					</div>
					<div class="" style="float:left">
						<h3><?php __('Products'); ?></h3>
						<ul>
							<li><?php echo $this->Html->link(__('Projects', true), array('controller' => 'projects', 'action' => 'index', 'admin'=>true)); ?>
								<ul>
									<li><?php echo $this->Html->link(__('Project Categories', true), array('controller' => 'project_categories', 'action' => 'index', 'admin'=>true)); ?></li>
								</ul>
							</li>
							<li><?php echo $this->Html->link(__('Products', true), array('controller' => 'products', 'action' => 'index', 'admin'=>true)); ?>
								<ul>
									<li><?php echo $this->Html->link(__('Comments', true), array('controller' => 'product_comments', 'action' => 'index', 'admin'=>true)); ?></li>
								</ul>
							</li>
						</ul>
					</div>
				<?php } ?>
				
				
				
				
				<?php if (!empty($user) && $group["Group"]["id"] == 2) { ?>
					<div class="user_mainbar" style="float:left">
						<h3><?php __('Phần quản trị dành cho thành viên'); ?></h3>
						<ul>
							<li
							<?php if(in_array($this->params['controller'], array('products', 'needs', 'fixprice_orders'))) echo ' class="activelink"'; ?>    
							><a href="#">Dịch vụ chính</a>
							
								<ul>
									<li <?php if(($this->params['controller'] == 'products')) echo ' class="activelink"'; ?>>
										<?php echo $this->Html->link(__('Bất động sản', true), array('controller' => 'products', 'action' => 'index', 'manager'=>true)); ?>
										<ul>
											<li <?php if(($this->params['controller'] == 'projects')) echo ' class="activelink"'; ?>>
												<?php echo $this->Html->link(__('Dự án', true), array('controller' => 'projects', 'action' => 'index', 'manager'=>true)); ?>
											</li>
										</ul>
									</li>
									
									<li <?php if(($this->params['controller'] == 'needs')) echo ' class="activelink"'; ?>>
										<?php echo $this->Html->link(__('Nhu cầu mua/thuê BĐS', true), array('controller' => 'needs', 'action' => 'index', 'manager'=>true)); ?></li>
									
									<li <?php if(($this->params['controller'] == 'fixprice_orders')) echo ' class="activelink"'; ?>>
										<?php echo $this->Html->link(__('Thẩm định giá BĐS', true), array('controller' => 'fixprice_orders', 'action' => 'index', 'manager'=>true)); ?></li>
								</ul>
							
							</li>
							
							<li
							<?php if(in_array($this->params['controller'], array('favorites', 'customers'))) echo ' class="activelink"'; ?>
							><a href="#">Quản trị</a>
								<ul>
									<li <?php if(($this->params['controller'] == 'favorites')) echo ' class="activelink"'; ?>>
									<?php echo $this->Html->link(__('BĐS quan tâm', true), array('controller' => 'favorites', 'action' => 'index', 'manager'=>true)); ?></li>
									<li <?php if(($this->params['controller'] == 'customers')) echo ' class="activelink"'; ?>>
									<?php echo $this->Html->link(__('Khách hàng liên lệ', true), array('controller' => 'customers', 'action' => 'index', 'manager'=>true)); ?></li>
								</ul>
							</li>
							
							<li
							<?php if(in_array($this->params['controller'], array('user_profiles', 'users'))) echo ' class="activelink"'; ?>
							><a href="#">Tài khoản</a>
								<ul>

									<li <?php if(($this->params['controller'] == 'user_profiles')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Sửa thông tin cá nhân', true), array('controller'=>'user_profiles', 'action'=>'editprofile'), array()); ?></li>
									<li <?php if(($this->params['controller'] == 'users')) echo ' class="active"'; ?>><?php echo $this->Html->link(__('Đổi mật khẩu', true), array('controller'=>'users', 'action'=>'changepassword'), array()); ?></li>			

								</ul>
							</li>
							
						</ul>
					</div>
				<?php } ?>
				<!--
				<?php if (!empty($user) && in_array($group["Group"]["id"],array(1,2))) { ?>
					<div class="" style="float:left">
						<h3><?php __('General'); ?></h3>
						<ul>						
							<li><?php echo $this->Html->link(__('Human Resources', true), array('controller' => 'human_resources', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('Device Resources', true), array('controller' => 'device_resources', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('Treatment Records', true), array('controller' => 'treatment_records', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('1816 Projects', true), array('controller' => 'n1816_projects', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('Science Projects', true), array('controller' => 'science_projects', 'action' => 'index', 'manager'=>true)); ?> </li>						
						</ul>
					</div>
					<div class="" style="float:left">
						<h3><?php __('NHD Activities'); ?></h3>
						<ul>
							<li><?php echo $this->Html->link(__('NHD Programs', true), array('controller' => 'nhd_programs', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('Human Resources', true), array('controller' => 'nhd_human_resources', 'action' => 'index', 'manager'=>true)); ?> </li>
							<li><?php echo $this->Html->link(__('Device Resources', true), array('controller' => 'nhd_device_resources', 'action' => 'index', 'manager'=>true)); ?> </li>
													
						</ul>
					</div>
				<?php } ?>
			-->
			</div>
			

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>

			<?php echo $content_for_layout; ?>			

		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>