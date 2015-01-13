<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="HomePlus Real Estate Theme" />   
<meta name="description" content="HomePlus Real Estate Theme" /> 


<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('home/style.css');
                echo $this->Html->css('home/bds.css');
		echo $this->Html->css('home/jquery-ui-1.8.16.custom.css');
		echo $this->Html->css('home/luan.css');
		echo $this->Html->css('home/wt-scroller.css');
		echo $this->Html->css('prettyPhoto');
		
		
		echo $this->Html->script('home/jquery.js');
                echo $this->Html->script('home/scrolltop.js');
                echo $this->Html->script('home/fancybox/jquery.mousewheel-3.0.4.pack.js');
                echo $this->Html->script('home/fancybox/jquery.fancybox-1.3.4.pack.js');
                echo $this->Html->script('home/fancybox/jquery.fancybox-1.3.4.js');
                echo $this->Html->script('home/tooltip.js');
                echo $this->Html->script('home/jquery.trigger.js');
                echo $this->Html->script('home/modal.js');
                echo $this->Html->script('home/jquery.ui.core.js');
                echo $this->Html->script('home/jquery.ui.datepicker.js');
		echo $this->Html->script('home/jquery.ui.widget.js');
		echo $this->Html->script('home/jquery.ui.tabs.js');
		echo $this->Html->script('home/jquery.ui.accordion.js');
		echo $this->Html->script('home/jquery.wt-scroller.min.js');
		
                echo $this->Html->script('home/superfish.js');
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=false');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('jshashtable-2.1');
		echo $this->Html->script('jquery.numberformatter-1.2.2.min');
               
                
			
		
		echo $scripts_for_layout;
	?>


<link rel="alternate" type="application/rss+xml" title="RSS [Templates]" href="http://feeds2.feedburner.com/themecss" />
<link rel="shortcut icon" href="#" />


<script type="text/javascript">
	jQuery(function(){
		jQuery('ul.sf-menu').superfish();
		
	});
</script>

<script type="text/javascript">

function updateCurrency()
{
		$.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "currencies", "action" => "updateCurrency"));?>',        
        success: function( data ) {
            if (console && console.log){
              //$("#DistrictId").html(data);
	      //alert($("#ProductDistrictId").val());
	      //ajaxFilterProject($("#ProductDistrictId").val());
	      //alert(data);
            }
          }
        });
}

	$(function() {
		$( "#datepicker" ).datepicker();
		$("a[rel^='prettyPhoto']").prettyPhoto();
		
		$("#PriceFrom").keyup(function(){
			$(this).parseNumber({format:"#,###", locale:"us"});
			$(this).formatNumber({format:"#,###", locale:"us"});
		});
		$("#PriceTo").keyup(function(){
			$(this).parseNumber({format:"#,###", locale:"us"});
			$(this).formatNumber({format:"#,###", locale:"us"});
		});
		
		$( "#tabs" ).tabs();
		
		$( "#accordion" ).accordion({ autoHeight: false });
		
		
		var $topslider = $(".topslider");	
		$topslider.wtScroller({
					num_display:7,
					slide_width:118,
					slide_height:84,
					slide_margin:15,
					button_width:35,
					ctrl_height:25,
					margin:10,	
					auto_scroll:true,
					delay:4000,
					scroll_speed:1000,
					easing:"",
					auto_scale:true,
					move_one:true,
					ctrl_type:"none",
					display_buttons:true,
					mouseover_buttons:false,
					display_caption:false,
					mouseover_caption:false,
					caption_align:"bottom",
					caption_position:"inside",					
					cont_nav:true,
					shuffle:false
				});
		
		
		
	});
	
	updateCurrency();
</script>


<title>MuaNhaOnline.com.vn</title>
</head>

<body>


<!--CALL & UPDATE-->
<div id="callus-update">
	<div class="main-call">
		<div class="callus">	
				<?php echo $this->element('logintop'); ?>
				<?php echo $this->element('currencybox');?>
		</div>
		<!--<ul>
			<li>Update us here:</li>
			<li><a href="#" class="tooltip" title="Follow us on Twitter"><img src="img/icons/twitter.png" alt="" title="" /></a></li>
			<li><a href="#" class="tooltip" title="Like us on Facebook"><img src="img/icons/facebook.png" alt="" title="" /></a></li>
			<li><a href="#" class="tooltip" title="Subscribe our Feeds"><img src="img/icons/rss.png" alt="" title="" /></a></li>
			<li><a href="#" class="tooltip" title="Watch our videos"><img src="img/icons/vimeo.png" alt="" title="" /></a></li>
		</ul>-->
	</div>
</div>


<!--MAIN CONTAINER--> 
<div id="container">	
        <!--TOP CONTENTS-->
	<div id="top-content">		
		<!--HEADER-->		
		<div class="header">
			<div class="header-inside clear">

				<div class="logo"><h1><a href="index.htm"></a></h1></div>
				<div class="menu clear" id="dropdown">
					<ul class="sf-menu">
						<li><a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>" <?php if($this->params['controller'] == 'home' && $this->params['action'] == 'index') echo ' class="activelink"'; ?>>Trang chủ</a></li>
						<li>
							<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'products') echo ' class="activelink"'; ?>>Bất động  sản</a>
							
						</li>
						<li>
							<a href="<?php echo $this->Html->url(array('controller'=>'projects')) ?>" <?php if($this->params['controller'] == 'projects') echo ' class="activelink"'; ?>>Dự án</a>
							
						</li>
                        <li><a href="<?php echo $this->Html->url(array('controller'=>'contents')) ?>" <?php if($this->params['controller'] == 'contents') echo ' class="activelink"'; ?>>Tin tức</a>
			
				<ul>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>2, 'category'=>'Tin tức BĐS')) ?>">Tin tức</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>2, 'category'=>'Tin tức BĐS')) ?>">Tin tức BĐS</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>3, 'category'=>'Tư vấn chuyên môn')) ?>">Tư vấn chuyên môn</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>4, 'category'=>'Ý kiến chuyên gia')) ?>">Ý kiến chuyên gia</a></li>
								
				</ul>
				
			</li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'aboutus')) ?>" <?php if($this->params['controller'] == 'home' && $this->params['action'] == 'aboutus') echo ' class="activelink"'; ?>>giới thiệu</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>" <?php if(($this->params['controller'] == 'users' && $this->params['action'] == 'register') || ($this->params['controller'] == 'user_profiles')) echo ' class="activelink"'; ?>>Thành viên</a>
								
										<?php if (!empty($user)) { ?>
										<ul>
												<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>" <?php if(($this->params['controller'] == 'users' && $this->params['action'] == 'register') || ($this->params['controller'] == 'user_profiles')) echo ' class="activelink"'; ?>>Sửa thông tin</a></li>
										
												<?php if ($group["Group"]["id"] == 2) { ?>																	
														<li><?php echo $this->Html->link(__('Phần quản trị', true), array('controller' => 'products', 'action' => 'index', 'manager'=>true)); ?></li>																											
												<?php } ?>
										</ul>
										<?php } ?>
								
						</li>

						<li><a href="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', 'id'=>"1")) ?>" <?php if(($this->params['controller'] == 'contacts' && $this->params['action'] == 'view') || ($this->params['controller'] == 'customers' && $this->params['action'] == 'contact')) echo ' class="activelink"'; ?>>Liên hệ</a></li>
					</ul>
				</div>
			</div>
		</div>		
		<?php echo $content_for_layout; ?>
		
		
		
		

		 
		 
		 
		 
	</div>
        
	<!--FOOTER CONTAINER-->
	<div class="footer">
		<div class="links">

			<label>
				<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a> / <a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'reset')) ?>">Bất động sản</a> / <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>">Thành viên</a> / <a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'aboutus')) ?>">Giới thiệu</a> / <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>">Tham gia</a> / <a href="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', 'id'=>"1")) ?>">Liên hệ</a>

			</label>
			<label>Bản quyền &copy; 2011. MuaNhaOnline.com.vn</label>
		</div>
		<div class="credits">
			<label><a href="#top" class="btop">Lên đầu trang</a></label>
			<label>Thiết kế và phát triển: <a href="#">HoangKhang</a> Incotech</label>

		</div>
	</div>
</div>

<!--MORTGAGE CALCULATOR AND ADVANCE SEARCH MODAL PLUGIN, please copy this everytime you add mortgage calculator and Advanced Search sidebar-->
<div id="calculator" class="popup">
	<h2>Mortgage Calculator</h2>
	<form action="#" method="post">
		<ul>
			<li><label>Home Value</label> <input type="text" name="home-value" /> $</li>

			<li>
				<label>Credit Profile</label> 
				<select name="credit-profile">
					<option value="Excellent">Excellent</option>
				</select>	
			</li>
			<li><label>Loan Amount</label> <input type="text" name="loan-amount" /> $</li>

			<li>
				<label>Loan Purpose</label>
				<select name="loan-purpose">
					<option value="New Purchase">New Purchase</option>
				</select>
			</li>
			<li><label>Interest Rate</label> <input type="text" name="interest-rate" class="small" /> %</li>

			<li><label>Loan Term</label> <input type="text" name="loan-term" class="small" /> years</li>
			<li><label>Start Date</label> <input type="text" name="start-date" id="datepicker" /></li>
			<li><label>Property Tax</label> <input type="text" name="property-tax" class="small" /> %</li>
			<li><label>PMI</label> <input type="text" name="pmi" class="small" /> %</li>

		</ul>
		<div class="clear">
			<input type="submit" name="calculate" value="Calculate" />
			<label>Your Monthly Payments</label>
			<span>$3,522.37</span>
		</div>
	</form>
</div>





<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2280256-12");
pageTracker._trackPageview();
} catch(err) {}</script>

<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
