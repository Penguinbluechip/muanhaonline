<script type="text/javascript">

	function changeCurrency(id, value, current)
	{
	    $('#currency_control_'+id+' a').attr('class', '');
	    current.setAttribute("class", "active");
	    
	    
	    $('#product-price_'+id).html(value);
	}	




 //Google Maps
    //Google Map
  var geocoder;
  var map;
  var marker;
  var infowindow;
  
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(16.21467, 106.83105);
	  var myOptions = {
	    zoom: 6,
	    center: latlng,
	    scrollwheel: false,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	  marker = new google.maps.Marker();
	}
  
	function movePosition(location) {
	  geocoder = new google.maps.Geocoder();
	  //var latlng = new google.maps.LatLng(-34.397, 150.644);
	  var myOptions = {
	    zoom: 14,
	    center: location,
	    scrollwheel: false,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	  
	  marker = new google.maps.Marker({
		  map: map,
		  position: location,
		  draggable:true,
		  animation: google.maps.Animation.DROP,
		  title: '<?php __('Location') ?>'
	      });
	  
	}

	function showInfo(address)
	{
		var contentString = address;
		infowindow = new google.maps.InfoWindow({content: contentString});
		infowindow.open(map,marker);
	}

	function codeAddress() {
	      //alert($('#ProjectCityId option:selected').text() );
	  var address = $('#ProductHomeNumber').val()+' '+$('#ProductStreet').val()+', '+$('#ProductDistrictId option:selected').text()+', '+$('#ProductCityId option:selected').text();
	  //alert(address);
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      //alert(results[0].geometry.location.x);
	      movePosition(results[0].geometry.location);	      
	      
	      showInfo(address);
	      google.maps.event.addListener(marker, 'mouseup', function() {
		updateForm(marker.getPosition());
		showInfo(address);
	      });
	      google.maps.event.addListener(marker, 'mousedown', function() {
		infowindow.close();		
	      });
	      //alert(marker.getPosition());
	      updateForm(results[0].geometry.location)
	    } else {
	      alert("Geocode was not successful for the following reason: " + status);
	    }
	  });
	}
	
	
  
	function updateForm(position)
	{
	      //alert(position.split(','));
	      //alert(position.split(')')[0].split(',')[0].split('(')[1]);
	      var po = new String(position);
	      $('#ProductLongitude').val(po.split(')')[0].split(',')[0].split('(')[1]);
	      $('#ProductLatitude').val(po.split(')')[0].split(',')[1].split(' ')[1]);
	}
</script>



		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'products',
											 'action'=>'index',
											 'filter_ctegory_id'=>$product["Category"]["id"],
											 'category'=>strtolower(Inflector::slug($product["Category"]["name"]))
											)),
						  'title'=>$product["Category"]["name"]);
				$breads[] = array('link'=>'', 'title'=>$product["Product"]["name"]);

				
				foreach($breads as $key => $item) {
			?>
				<?php if($key == count($breads)-1) { ?>
					<label><?php echo $item['title'] ?></label>
				<?php } else { ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a> <span>&nbsp;</span>
				<?php } ?>
			<?php } ?>
			 
		</div>	
		
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Bất Động Sản</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->element('underconstruction'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--SIDEBARS-->		
		<div class="left-sidebar">
			<!--SEARCH PROPERTIES-->
			<div class="hinhcanho">
			  <?php if(count($images)) { ?>
						<a href="<?php echo $this->Html->url("/uploads/product_image/filename/".$images[0]["ProductImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $images[0]["ProductImage"]["title"] ?>">
							<?php echo $this->Html->image("/uploads/product_image/filename/thumb/feature/".$images[0]["ProductImage"]["filename"], array('title' => $images[0]["ProductImage"]["title"],'height'=>'200', 'width'=>'330', 'class'=>'hinhlon')); ?></a>
			  <?php } else { ?>
			    <?php echo $this->Html->image("/img/home/noimage_300x200.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'200', 'width'=>'300', 'class'=>'hinhlon')); ?>
			  <?php } ?>
						<ul>
							<?php foreach ($images as $kk => $img):
								if($kk) {
							?>
								<li><a href="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" rel="prettyPhoto[p-image]"><img src="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" width="70" height="50" alt="" /></a></li>
								
							<?php } endforeach; ?>
						</ul>
			</div>
			
				  <?php if($user) { ?>
				    <div id="expert-contact" class="categories1" style="height:40px; padding-right:20px;">
							  <?php if(!$product["isFavorite"]) { ?>
								  <a class="poplight view-more" title="Thêm <?php echo $product['Product']['name']; ?> vào lưu trữ" href="<?php echo $this->Html->url(array('controller'=>'favorites', 'action'=>'addFavorite', $product["Product"]["id"])) ?>" style="float:right;margin-top:5px">
									  <span style="color:#fff">Lưu tin</span>
									</a>
							  <?php } else { ?>
								  <a class="poplight view-more" title="Bỏ <?php echo $product['Product']['name']; ?> khỏi lưu trữ" href="<?php echo $this->Html->url(array('controller'=>'favorites', 'action'=>'removeFavorite', $product["Product"]["id"])) ?>" style="float:right;margin-top:5px">
									  <span style="color:#fff">Hủy lưu</span>
									</a>
							  <?php } ?>
				    </div>
				  <?php } ?>
			  
			<!--CATEGORIES-->
			<div class="categories1">
				<div class="chuyenvien">
				<?php if($profile["UserImage"]["filename"] != "") { ?>
						<?php echo $this->Html->image("/uploads/user_image/filename/thumb/default/".$profile["UserImage"]["filename"], array('title' => $profile["UserImage"]["title"],'height'=>'95px')); ?>				
				<?php } ?>
				
				
				</div>
				<ul>
					<?php if(isset($profile['Company'])) { ?><li><strong><?php echo $profile['Company']['name'] ?></strong></li> <?php } else { ?>
						<li><strong><?php echo $profile['UserProfile']['name'] ?></strong></li>
					<?php } ?>
					
					<li><?php echo $profile['UserProfile']['mobile'] ?></li>
					<li><a href="#"><?php //echo $profile['UserProfile']['email'] ?></a></li>
					<li><a href="#?w=409" rel="expert-contact" class="view-more poplight"><span class="but">Liên hệ chuyên viên</span></a>
						
					</li>
				</ul>
				
				<div id="expert-contact" class="popup">
					<h2>Liên hệ chuyên viên</h2>
					<form action="<?php echo $this->Html->url(array('controller'=>'customers', 'action' => 'contact')); ?>" method="POST" id="contact-expert">
						<input type="hidden" name="data[Customer][product_id]" id="ProductId" value="<?php echo $product["Product"]["id"] ?>" />
						<input type="hidden" name="data[Customer][user_id]" id="UserId" value="<?php echo $profile['UserProfile']['user_id'] ?>" />
						<ul>
							<li><label>Họ và Tên</label> <input type="text" name="data[Customer][name]" id="CustomerName" /> <span class="error">*</span></li>
							<li><label>Điện thoại</label> <input type="text" name="data[Customer][phone]" id="CustomerPhone" /> <span class="error">*</span></li>
							<li><label>Email</label> <input type="text" name="data[Customer][email]" id="CustomerEmail" /> <span class="error">*</span></li>							
							<li><label>Nội dung</label> <textarea name="data[Customer][message]" id="CustomerMessage" cols="45" rows="8" ></textarea> <span class="error">*</span></li>
							<!--<li style="display:none">
								<label>Mã bảo mật</label>
								<?php App::import('Vendor', 'recaptcha', array('file' => 'recaptchalib.php'));
					    
									//require_once('recaptchalib.php');
									$publickey = "6LckqMkSAAAAABOO3mI02a_7d2XWpYR6EVMibaGl"; // you got this from the signup page
									echo recaptcha_get_html($publickey);
					    
								
								?>
							</li>-->
						</ul>
						<div class="clear">
							<input type="submit" name="Tìm" value="Gửi" />
							<label class="text">Gửi email tới chuyên viên, để được hướng dẫn trực tiếp từ chuyên viên.</label>
						</div>
				
					</form>
				</div>
			</div>
			<!--SIDEBAR PARAGRAPH-->
			<div id="relate_estate">
			<h3>BDS liên quan</h3>
			
				<?php foreach($relatedProducts as $item) { if($item['Product']['id'] != $product['Product']['id']) { ?>
					<div class="categories2">
						
					<div class="info">						
						<ul>
							<li><a href="<?php echo $this->Html->url($item["Product"]["link"]) ?>" style="text-decoration:none;color:#333"><strong><?php echo $item["Product"]["name"] ?></strong></a></li>
							<li><strong>Giá:</strong>
							
							<?php if($item['Product']['price']) { ?>
								<span class="pprice" id="product-price_<?php echo $item["Product"]["id"] ?>"><?php echo $item["prices"][$item["CurrencyPrice"]["id"]]["value"]; ?>&nbsp;</span>
								<span class='currency_control' style="margin-right:20px" id="currency_control_<?php echo $item["Product"]["id"] ?>">
									<?php foreach($item["prices"] as $cu) { ?>
										<?php if($cu['id'] != 2) echo "|"; ?> <a href="#chang_cur" class='<?php echo $cu['id'] == $item["CurrencyPrice"]["id"] ? 'active' : ''; ?>' onclick="changeCurrency('<?php echo $item["Product"]["id"] ?>', '<?php echo $cu["value"] ?>', this)"><?php echo $cu["code"] ?></a>
									<?php } ?>
								</span>
							<?php } else { ?>
								<span class="pprice">thương lượng &nbsp;</span>
							<?php } ?>
							
							  
							</li>
							<li class="list">Loại: <strong><?php echo $item['Type']['name'] ?></strong></li>
							<?php if($item['Type']['id'] != 3) { ?>
							  <li>DT sử dụng: <strong><?php echo $item['Product']['property_area'] ?>m<sup>2</sup></strong></li>
							<?php } else { ?>
							  <li>Diện tích: <strong><?php echo $item['Product']['lot_area'] ?>m<sup>2</sup></strong></li>
							<?php } ?>							
							
							<?php if($item['Type']['id'] != 3) { ?>
							  <li class="list">Năm xây: <strong><?php echo date("Y", strtotime($item['Product']['build_date'])); ?></strong></li>
							<?php } ?>
							
						</ul>
					</div>
						<div class="bds">
						  <?php if(count($item["ProductImage"])) { ?>
							<?php echo $this->Html->image("/uploads/product_image/filename/thumb/default/".$item["ProductImage"][0]["filename"], array('title' => $item["ProductImage"][0]["title"],'height'=>'85', 'width'=>'90')); ?>
						  <?php } else { ?>
							<?php echo $this->Html->image("/img/home/noimage_90x85.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'85', 'width'=>'90')); ?>
						  <?php } ?>
						  
						  
						</div>
					</div>
				<?php }} ?>
			
			
			</div>
			
			<!--COMMENTS-->
			
			
			
		</div>
		
		<!--LEFT CONTENT-->			
		<div class="right-content">		
			<!--ABOUT INTRO TEXT-->
					<div class="thongtincanho">
					
						<h4><?php echo $product["Product"]["name"] ?></h4>
						<span><strong>Thời gian đăng:</strong> <?php echo $product["Product"]["create_date"] ?></span><br />
						<span><strong>Giá:</strong>
						
						<?php if($product['Product']['price']) { ?>
							<span class="pprice" id="product-price_<?php echo $product["Product"]["id"] ?>"><?php echo $product["prices"][$product["CurrencyPrice"]["id"]]["value"]; ?>&nbsp;</span>
							<span class='currency_control pprice' style="margin-right:20px" id="currency_control_<?php echo $product["Product"]["id"] ?>">
								<?php foreach($product["prices"] as $cu) { ?>
									<?php if($cu['id'] != 2) echo "|"; ?> <a href="#chang_cur" class='<?php echo $cu['id'] == $product["CurrencyPrice"]["id"] ? 'active' : ''; ?>' onclick="changeCurrency('<?php echo $product["Product"]["id"] ?>', '<?php echo $cu["value"] ?>', this)"><?php echo $cu["code"] ?></a>
								<?php } ?>
							</span>
						<?php } else { ?>
								<span class="pprice">thương lượng &nbsp;</span>
						<?php } ?>
						
						</span>
						<ul style="clear: both">
							<li>MLS: <strong># RE<?php echo $product['Product']['id']; ?></strong></li>
							<li>Hình thức: <strong><?php $fors = array("s"=>__('Bán', true),"l"=> __('Cho thuê', true),"m"=> __('Cần mua', true));echo $fors[$product['Product']['for']]; ?></strong></li>
							
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Phòng ngủ: <strong><?php echo $product['Product']['bedrooms'] ?></strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>DT sử dụng: <strong><?php echo $product['Product']['property_area'] ?>m<sup>2</sup></strong></li>
							<?php } else { ?>
							  <li>Diện tích: <strong><?php echo $product['Product']['lot_area'] ?>m<sup>2</sup></strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Tầng: <strong><?php echo $product['Product']['floors'] ?></strong></li>
							  <li>Phòng tắm: <strong><?php echo $product['Product']['bathrooms'] ?></strong></li>
							  
							<?php } ?>
							
						</ul>
						<br />							
						Địa chỉ: <strong>
							
								<?php echo $product['Product']['block']; ?>
								<?php echo $product['Product']['home_number'];?>
								
								<?php //echo $product['Product']['street'] != '' ? $product['Product']['street'].", " : '' ;?>
								<?php if(isset($product['Street']['name'])) echo $product['Street']['name'].", "; ?>
								<?php if(isset($product['Ward']['name'])) echo $product['Ward']['name'].", "; ?>
								<?php echo $product['District']['name']; ?>,
								<?php echo $product['City']['name']; ?>
								&nbsp;
						</strong>
						
						<div class="p_descr"><?php echo $product['Product']['description'] ?></div>
					</div>
			<!--MEET OUR TEAM-->
					<div class="motabds">
						<h4>Mô tả Bất động sản</h4>
						<ul>
							<?php if($product['Project']['id']) { ?>
							  <li>Dự án: <a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($product["City"]["name"])),
													     'id'=>$product["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($product['Project']["name"])))) ?>"><strong><?php echo $product['Project']['name'] ?></strong></a></li>
							<?php } else if($product['Product']['project_other']) { ?>
							     <li>Dự án: <?php echo $product['Product']['project_other'] ?> </li>
							<?php } ?>
							<li>Loại BĐS: <strong><?php echo $product['Type']['name'] ?></strong></li>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Tầng: <strong><?php echo $product['Product']['floors'] ?></strong></li>
							<?php } ?>
							<li>Loại giấy tờ: <strong><?php echo $product['Certificate']['name'] ?></strong></li>
							<!--<li>Năm xây: <strong><?php echo date("Y", strtotime($product['Product']['build_date'])); ?></strong></li>-->
							<li>Ngày đăng BĐS: <strong><?php echo date("d/m/Y", strtotime($product['Product']['ncreate_date'])); ?></strong></li>
							<?php if($product['Product']['property_area'] && $product['Type']['id'] != 3) { ?>
							  <li>Diện tích sử dụng: <strong><?php echo $product['Product']['property_area'] ?>m<sup>2</sup></strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							 
							  <li>Diện tích: <strong><?php echo $product['Product']['lot_area'] ?>m<sup>2</sup></strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Năm xây: <strong><?php echo date("Y", strtotime($product['Product']['build_date'])) ?></strong></li>
							<?php } ?>
							
							<?php if($product['Product']['area_x'] && $product['Product']['area_y'] && $product['Type']['id'] != 2) { ?>
							  <li>DTKV: <strong><?php echo $product['Product']['area_x']."m x ".$product['Product']['area_y'] ?>m<?php echo $product['Product']['area_back'] != '' ? " x ".$product['Product']['area_back'].'m' : ''; ?>
							  &nbsp;&nbsp;(<?php echo $product['Product']['lot_area'] ?>m<sup>2</sup>)</strong></li>
							<?php } ?>
							
							<?php if($product['OccupantType']['name']) { ?>
							  <li>Tình trạng định cư: <strong><?php echo $product['OccupantType']['name'] ?></strong></li>
							<?php } ?>
							
							<li>Hướng: <strong>
								<?php
									$directions = array("e"=> __("Đông", true),
											    "w"=> __("Tây", true),
											    "s"=> __("Nam", true),
											    "n"=>__("Bắc", true),
											    "es"=> __("Đông Nam", true),
											    "en"=> "Đông Bắc",
											    "ws"=> __("Tây Nam", true),
											    "wn"=> __("Tây Bắc", true),
											    "0"=> __("Khác", true));
									echo $directions[$product['Product']['direction']];
								?>
							</strong></li>
							<?php if($product['Product']['build_structure'] && $product['Type']['id'] != 3) { ?>
							  <li>Kết cấu xây dựng: <strong><?php echo $product['Product']['build_structure'] ?></strong></li>
							<?php } ?>
							<?php if($product['Product']['wc'] && $product['Type']['id'] != 3) { ?>
							  <li>WC: <strong><?php echo $product['Product']['wc'] ?></strong></li>
							<?php } ?>
							<?php if($product['Product']['living_rooms'] && $product['Type']['id'] != 3) { ?>
							  <li>Phòng khách: <strong><?php echo $product['Product']['living_rooms'] ?></strong></li>
							<?php } ?>
							<?php if($product['Product']['base'] != 'ký gởi môi giới') { ?>
							  <li>Thông tin cơ bản: <strong><?php echo $product['Product']['base'] ?></strong></li>
							<?php } else { ?>
							  <li>Chiết khấu: <strong><?php echo $product['Product']['base_cost'] ?>%</strong></li>
							<?php } ?>
							
							
						</ul>
						<h3 style="margin-left: 10px;padding-top: 10px;font-size: 14px;font-style:italic;clear:both">Các tiện ích: </h3>						
						<ul style="margin-left: 20px">
						  <?php $p = 0;foreach($pus as $k => $pu) { if($pu["ProductsUtility"]["value"] == 1) { ?>
						    <li class="pu_item"><?php echo $pu["Utility"]["name"] ?></li>
						  <?php } $p++; } ?>
						</ul>
						<?php if (!$p) echo '<div style="margin-left: 20px" class="pu_item">(trống)</div>'; ?>
					</div>
					
			<!--MISSION AND VISION-->
					
					
					
					<div class="vitri" style="height:auto;clear:both">
							<h4>Vị trí</h4>
							
							<div id="google-map">
								<div id="map_canvas" style="width:571px; height:500px; border:solid 2px #cccccc;"></div>
							</div>
					</div>
					
					<div class="vitri" style="height:auto;clear:both">
					
					
					    <div id="tabs" style="margin:0 -10px 10px -10px;">
						    <ul>
							    <li><a href="#tabs-2">Đánh giá từ chuyên gia</a></li>
							    <li><a href="#tabs-1">Phản hồi</a></li>
							    
						    </ul>
						    
						    <div id="tabs-1">
							    <?php echo $this->element('commentbox_expert'); ?>
						    </div>
						    
						    <div id="tabs-2">
							<?php echo $this->element('commentbox'); ?>
						    </div>
						    
					    </div>
					
					
							
							
							
					</div>
					
					<div class="" style="margin: 0 5px 10px 0;float: right">
						<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_facebook"></a>
<a class="addthis_button_twitter"></a>
<a class="addthis_button_google_plusone_share"></a>
<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-520993b51c3b7da7"></script>
<!-- AddThis Button END -->
					</div>
		</div>			
		<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
		</div>


<script type="text/javascript">
//Goodle Map
initialize();
<?php if($product["Product"]["longitude"].$product["Product"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $product["Product"]["longitude"] ?>, <?php echo $product["Product"]["latitude"] ?>));
<?php } ?>
</script>


<div id="login" class="popup">
	<h2>Đăng nhập</h2>
	<form method="post" action="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')); ?>" id="login-form">
		<ul>
			<li><label>Tên đăng nhập</label> <input type="text" name="data[User][username]" class="large" value="" /></li>
			<li><label>Mật mã</label> <input type="password" name="data[User][password]" class="large" value="" /></li>
			
			

			
		</ul>
		<div class="clear">
			<input type="submit" name="Tìm" value="Đăng nhập" />
			<label class="text">Đăng nhập vào hệ thống.</label>
		</div>

	</form>
</div>