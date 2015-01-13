<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php if(isset($meta_keywords) && $meta_keywords != "") { ?>
<meta name="keywords" content="<?php echo $meta_keywords ?>" />
<?php } else { ?>
<meta name="keywords" content="batdongsan,batdong san ,Nha dat , bat dongsan, bat dong san , muaban,mua bán , mua ban,bán nhà , ban nha , bannha,thuenha,thue nha , thuê nhà,muabannhadat,mua bán nhà đất , mua ban nha dat,dia oc , vat lieu , xay dung ,bảng giá nhà đất , bang gia nha dat, du an , quy hoach , nha , dat , mua nha , mua ban nha dat, muanhaonline , mua nhà online , mua nha truc tuyen" />
<?php } ?>


<?php if(isset($meta_description) && $meta_description != "") { ?>
<meta name="description" content="<?php echo $meta_description ?>" />
<meta property="og:description" content="<?php echo $meta_description ?>"/>
<?php } else { ?>
<meta name="description" content="muanhaonline.com.vn - khám phá giá trị thực trong tầm tay" /> 
<?php } ?>

<?php if(isset($facedes)) { ?>
	<meta property="og:description" content="<?php echo $facedes ?>"/>
<?php } ?>

<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('home/style.css');
                echo $this->Html->css('home/bds.css');
		echo $this->Html->css('home/jquery-ui-1.8.16.custom.css');
		echo $this->Html->css('home/luan.css');
		echo $this->Html->css('home/wt-scroller.css');
		//echo $this->Html->css('home/fancybox/jquery.fancybox.css');
		echo $this->Html->css('prettyPhoto');
		
		
		echo $this->Html->script('home/jquery.js');
                echo $this->Html->script('home/scrolltop.js');
                //echo $this->Html->script('home/fancybox/jquery.mousewheel-3.0.4.pack.js');
                //echo $this->Html->script('home/fancybox/jquery.fancybox-1.3.4.pack.js');
                //echo $this->Html->script('home/fancybox/jquery.fancybox.js');
                echo $this->Html->script('home/tooltip.js');
                echo $this->Html->script('home/jquery.trigger.js');
                echo $this->Html->script('home/modal.js');
                echo $this->Html->script('home/jquery.ui.core.js');
                echo $this->Html->script('home/jquery.ui.datepicker.js');
		echo $this->Html->script('home/jquery.ui.widget.js');
		echo $this->Html->script('home/jquery.ui.tabs.js');
		echo $this->Html->script('home/jquery.ui.accordion.js');
		echo $this->Html->script('home/jquery.wt-scroller.min.js');
		echo $this->Html->script('home/jquery.bxSlider.min.js');
		
                echo $this->Html->script('home/superfish.js');
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js?key=AIzaSyCi_EKB31aYLUuZfnb3iCaEQ4SMQeKPnPQ&sensor=false');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('jshashtable-2.1');
		echo $this->Html->script('jquery.numberformatter-1.2.2.min');
		echo $this->Html->script('home/jquery.jixedbar.js');
		
		echo $this->Html->script('tiny_mce/tiny_mce.js');
		echo $this->Html->script('jquery.validate');
               
                
			
		
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
	
	function hideLogboxes()
	{
		$('.logbox').fadeOut(200);
		setTimeout("$('#registerbox .main-content').html('<div class=\"resloading\"></div>')", 200);
	}
	
	function showRegisterBox()
	{
		hideLogboxes();
		$('#registerbox').fadeIn();
		
		$.ajax({			
			url: '<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'ajax_register')) ?>',
			success: function(data) {
			 
				//alert(data);
				$('#registerbox .main-content').html(data);
				
				$("#registerbox form").validate({
					rules: {							
							'data[User][username]': {
								required: true,
								minlength: 4
							},
							'data[User][email]': {
								required: true,
								email: true
							},						
							'data[User][password]': {
								required: true,
								minlength: 5
							},
							'data[User][confirm_password]': {
								required: true,
								minlength: 5,
								equalTo: "#registerbox #UserPassword"
							},
							'data[UserProfile][name]': "required",
							'data[UserProfile][mobile]': "required",
							'data[UserProfile][address]': "required",
							'data[User][ver_code]': "required"
						},
					messages: {						
						'data[User][username]': {
							required: "Yêu cầu nhập",
							minlength: "Tối thiểu 4 ký tự"
						},
						'data[User][password]': {
							required: "Yêu cầu nhập",
							minlength: "Tối thiểu 5 ký tự"
						},
						'data[User][confirm_password]': {
							required: "Yêu cầu nhập",
							minlength: "Tối thiểu 5 ký tự",
							equalTo: "Mật khẩu không khớp"
						},
						'data[User][email]': "Định dạng email không đúng",
						'data[UserProfile][name]': "Yêu cầu nhập",
						'data[UserProfile][mobile]': "Yêu cầu nhập",
						'data[UserProfile][address]': "Yêu cầu nhập",
						'data[User][ver_code]': "Yêu cầu nhập"
					}
				});
			  
			}		   
		}); 
	}
	
	function postLoginForm()
	{
		dataString = $("#loginbox form").serialize();
		
		$("#loginbox form .btsubmit").addClass('hide');
	     
		$.ajax({
			type: "POST",
			url: $("#loginbox form").attr("action"),
			data: dataString,
			success: function(data) {
			 
				//alert(data);
				if (data != "0") {
					if (data == "reload") {
						location.reload();
					}
					else
					{
						window.location = data;
					}				    
					//alert(data);
				}
				else
				{
				    $('#loginbox .error').html("Tên đăng nhập hoặc mật khẩu không đúng!");
				    $("#loginbox form .btsubmit").removeClass('hide');
				}
			  
			}		   
		}); 
		
	}
	function showLogBox(redirect)
	{		
		$('#redirect_login').val(redirect);
		hideLogboxes();
		$('#loginbox').fadeIn();	
	}
	
    function checkSubmitUser()
    {
        //alert("sdfsdfsf");
        if($('#UserUsername').val() != "Tên đăng nhập" && $('#UserUsername').val() != "")
        {
            //alert("ok");
            return true;
        }
        else
        {
            alert("Bạn phải nhập tên đăng nhập");
            return false;
        }
        
    }


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
		$("#NeedPriceFrom").keyup(function(){
			$(this).parseNumber({format:"#,###", locale:"us"});
			$(this).formatNumber({format:"#,###", locale:"us"});
		});
		$("#NeedPriceTo").keyup(function(){
			$(this).parseNumber({format:"#,###", locale:"us"});
			$(this).formatNumber({format:"#,###", locale:"us"});
		});
		
		$( "#tabs" ).tabs();
		
		$( "#accordion" ).accordion({ autoHeight: false, collapsible: true });
		
		
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
		

		//auto scroller
		//$("#control_bar").jixedbar({position: 'bottom'});
		
		//auto scroller
		var checking = setInterval(function() {
				$.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "users", "action" => "autoOnline", "admin" => false));?>',        
				success: function( data ) {
								if (console && console.log){
										
								}
						}
				});
		},60000);
		
		//fancybox login
		//$('.fancybox-link').fancybox();
		
		
		//Log box
		$('.logbox .loginbox_bg, .logbox .close_but').click(function() {
			hideLogboxes();
			
			
		});
		
		$('#loginbox #btncontact').click(function(e){
			e.preventDefault();
			postLoginForm();
		});
		
		$('#registerbox .main-content').css("max-height",$(window).height()-70);
				
		
		
	});
	
	updateCurrency();
	
$(document).ready(function() {
    $("#control_bar").css("position", "absolute");
    
    tinyMCE.init({
			mode : "textareas",
			theme : "advanced",   //(n.b. no trailing comma, this will be critical as you experiment later)
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left"

		});
    
    
});

$(window).scroll(function() {
    $("#control_bar").css("bottom", "-" + $(window).scrollTop() + "px");    
});
$(window).resize(function() {    
    $('#registerbox .main-content').css("max-height",$(window).height()-70);
});

</script>


<title><?php if(isset($page_title)) echo $page_title; else echo "MuaNhaOnline.vn - Trang chủ" ?></title>

<script type="text/javascript">



  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27986634-1']);
  _gaq.push(['_setDomainName', 'muanhaonline.com.vn']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();



</script>


<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?1YeEUjXYkoNrUpTUHifoCYVnSb868G0T';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->


</head>

<body>
	<div id="control_bar">
		<div class="contain_bar">
				
			
			<?php if(!empty($user)) { ?>
				<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'add', 'manager'=>true)) ?>">Đăng tin BĐS</a> |
				<a href="<?php echo $this->Html->url(array('controller'=>'needs', 'action'=>'guest_add')) ?>">Đăng ký mua/thuê BĐS</a> |
				<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>">Đăng ký thẩm định BĐS</a>
			<?php } else { ?>
				<a href="#login" onclick="showLogBox('product')">Đăng tin BĐS</a> |
				<a href="#login" onclick="showLogBox('need')">Đăng ký mua/thuê BĐS</a> |
				<a href="#login" onclick="showLogBox('fixprice')">Đăng ký thẩm định BĐS</a>			
			<?php } ?>
		</div>
	</div>

<!--CALL & UPDATE-->
<div id="callus-update">
	<div class="main-call">
		<div class="callus">	
				<?php echo $this->element('logintop'); ?>
				<?php //echo $this->element('currencybox');?>
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

				<div class="logo"><h1><a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>"></a></h1></div>
				<div class="menu clear" id="dropdown">
					<?php echo $this->element('mainnav'); ?>
				</div>
			</div>
		</div>		
		<?php echo $content_for_layout; ?>
		
		
		
		<script type="text/javascript">
(function($){	
  $(function(){
    $('#slider1').bxSlider({
      mode: 'vertical',
      displaySlideQty: 4,
    moveSlideQty: 2,
    auto: true,
    pause: 5000,
    controls: false,
    speed:1000
    });
  });
  
  $(function(){
    $('#slidernews').bxSlider({
      mode: 'vertical',
      displaySlideQty: 3,
    moveSlideQty: 1,
    auto: true,
    pause: 8000,
    controls: false,
    speed:1000
    });
  });
}(jQuery))
</script>



		 
		 
		 
		 
	</div>
        
	<!--FOOTER CONTAINER-->
	<div class="footer">
		<div class="links">
				<?php echo $this->element('menubottom'); ?>
			<!--<label>
				<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a> / <a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'reset')) ?>">Bất động sản</a> / <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>">Thành viên</a> / <a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'aboutus')) ?>">Giới thiệu</a> / <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>">Tham gia</a> / <a href="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', 'id'=>"1")) ?>">Liên hệ</a>

			</label>-->
			<label><strong>Công Ty TNHH Tư Vấn BĐS Thịnh An</strong><br />
			Tầng 1, Tòa nhà Rosana, số 60 Nguyễn Đình Chiểu, Phường Đa Kao, Quận 1, Tp. HCM. <br />
			ĐT: (84-8) 2221 1906 - Fax: (84-8) 222 02201</label>
			<label>Bản quyền &copy; 2011. MuaNhaOnline.vn</label>
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
		<!--<ul>
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
		</ul>-->
		<div class="clear">
			<input type="submit" name="calculate" value="Calculate" />
			<label>Your Monthly Payments</label>
			<span>$3,522.37</span>
		</div>
	</form>
</div>


<?php if(empty($user)) { ?>
	<div id="loginbox" class="logbox">
			<div class="loginbox_bg"></div>
		<div style="" class="login-inner">
			<div class="close_but">X</div>
			<div class="fillupform">
					
					<?php if(empty($user)) { ?>
					
						<h2>Đăng nhập</h2>
						
						<p>Bạn phải đăng nhập để có thể sử dụng dịch vụ này.<br />Nếu chưa có tài khoản thành viên, bạn cần <a href="#res" ><strong style="cursor: pointer" onclick="showRegisterBox()">Đăng ký</strong></a> với chúng tôi.</p>
						<?php
						    echo $this->Form->create('User', array('action'=>'login', 'controller'=>'users'));
						    ?>
							
							<input type="hidden" name="redirect" value="" id="redirect_login" />
							<input type="hidden" name="ajax" value="1" />
							
							<div class="error"></div>
							
							<ul class="clear contact login_form"> 
								<li>
									<?php echo $this->Form->input('username', array('label'=>'Tên đăng nhập')); ?>
								</li>
		
								<li>
									<?php echo $this->Form->input('password', array('label'=>'Mật khẩu')); ?>
								</li>
		
								<li>
									<label>&nbsp;</label>        
									<input class="btsubmit" type="submit" name="data[btsend]" value="Đăng nhập" id="btncontact" />
									<br /><a class="forget_pass" href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'forget_password')) ?>" >Quên tên đăng nhập/mật khẩu?</a><br />
									
									
								</li>
								
							 </ul>
						<?php
						    echo $this->Form->end();
						?>
					
					<?php } else { ?>
						
						Chào <strong><?php echo $user['username'] ?></strong>, 
						
						<?php echo $this->Html->link('Đăng xuất', array('plugin'=>null, 
										'admin'=>false, 'controller'=>'users', 'action'=>'logout')); ?>
					<?php } ?>
					
				</div>
		</div>
	</div>
	
	<div id="registerbox" class="logbox">
			<div class="loginbox_bg"></div>
		<div style="" class="login-inner">
			<div class="close_but">X</div>
			<div class="main-content">
					
				<div class="resloading"></div>
					
				</div>
		</div>
	</div>
	
<?php } ?>


<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
