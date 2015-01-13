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
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Thẩm định BĐS - Bước 1: Thanh toán phí thẩm định');

				
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
		
		
		<!--LEFT CONTENT-->			
		<div class="left-content" style="width:100%">
                        
			<?php //echo $this->element('checkoutline'); ?>
                        
                        <h2 class="fix_heading" style="">Hồ sơ <?php echo $fixprice_order['FixpriceService']['name']; ?> <?php echo $fixprice_order['FixpriceType']['name']; ?> </h2>
			<!--ABOUT INTRO TEXT-->
					<div class="motabds">
						<h4>Thông tin khách hàng</h4>
						<ul>
							<li>Tên khách hàng: <strong><?php echo $profile['UserProfile']['name'] ?></strong></li>
							<li>Email: <strong><?php echo $user['email'] ?></strong></li>
							<li>Số điện thoại: <strong><?php echo $profile['UserProfile']['mobile'] ?></strong></li>
							<li>Địa chỉ: <strong><?php echo $profile['UserProfile']['address'] ?></strong></li>
							
							
						
							
							
							
						</ul>
													
						
						
						<?php //echo $product['Product']['description'] ?>
					</div>
					
					<!--MEET OUR TEAM-->
					<div class="motabds">
						<h4>Mô tả Bất động sản</h4>
						
						<ul>
							<li style="width: 560px">
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
							</li>
							
							<?php if(!empty($fors)) { ?>
								<li>Hình thức: <strong><?php $fors = array("s"=>__('Bán', true),"l"=> __('Cho thuê', true),"m"=> __('Cần mua', true));echo $fors[$product['Product']['used_for']]; ?></strong></li>
							<?php } ?>
							
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Phòng ngủ: <strong><?php echo $product['Product']['bedrooms'] ?></strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>DT xây dựng: <strong><?php echo $product['Product']['property_area'] ?>m2</strong></li>
							<?php } else { ?>
							  <li>Diện tích: <strong><?php echo $product['Product']['lot_area'] ?>m2</strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Lầu: <strong><?php echo $product['Product']['floors'] ?></strong></li>
							  <li>Phòng tắm: <strong><?php echo $product['Product']['bathrooms'] ?></strong></li>
							  
							<?php } ?>
							
							
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
							  <li>Diện tích sử dụng: <strong><?php echo $product['Product']['property_area'] ?>m2</strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>DT xây dựng: <strong><?php echo $product['Product']['property_area'] ?>m2</strong></li>
							<?php } else { ?>
							  <li>Diện tích: <strong><?php echo $product['Product']['lot_area'] ?>m2</strong></li>
							<?php } ?>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>Năm xây: <strong><?php echo date("Y", strtotime($product['Product']['build_date'])) ?></strong></li>
							<?php } ?>
							
							<?php if($product['Product']['area_x'] && $product['Product']['area_y'] && $product['Type']['id'] != 2) { ?>
							  <li>DTKV: <strong><?php echo $product['Product']['area_x']."m x ".$product['Product']['area_y'] ?>m<?php echo $product['Product']['area_back'] != '' ? " x ".$product['Product']['area_back'].'m' : ''; ?>
							  &nbsp;&nbsp;<!--(<?php echo $product['Product']['lot_area'] ?>m2)--></strong></li>
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
							<li>Mục đích sử dụng: <strong><?php echo $product['Product']['used_for'] ?></strong></li>
							
							
						</ul>
						<h3>Các tiện ích: </h3>						
						<ul style="margin-left: 20px">
						  <?php $p = 0;foreach($pus as $k => $pu) { if($pu["ProductsUtility"]["value"] == 1) { ?>
						    <li class="pu_item"><?php echo $pu["Utility"]["name"] ?></li>
						  <?php } $p++; } ?>
						</ul>
						<?php if (!$p) echo '<div style="margin-left: 20px" class="pu_item">(trống)</div>'; ?>
						
						<h3>Mô tả cho sản phẩm: </h3>
						<div>
							<?php echo $product['Product']['description'] ?>
						</div>
						
						<h3>Bảng thông tin chi tiết quy hoạch: </h3>
						<table id="gtable" width="100%">
							<tr>
								<td rowspan="2" align="center" valign="middle">STT</td>
								<td rowspan="2" align="center" valign="middle">Hạng mục</td>
								<td colspan="2" align="center" valign="middle">Diện tích trong chủ quyền</td>
								<td colspan="2" align="center" valign="middle">Diện tích ngoài chủ quyền</td>
							</tr>
							<tr>
								<td align="center">Phù hợp quy hoạch</td>
								<td align="center">Không phù hợp</td>
								<td align="center">Phù hợp quy hoạch</td>
								<td align="center">Không phù hợp</td>
							</tr>
							<tr>
								<td align="center">1</td>
								<td>Đất</td>
								<td><?php echo $fixprice_order['FixpriceGtable']['ground_in'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['ground_in_not'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['ground_out'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['ground_out_not'] ?></td>
							</tr>
							<tr>
								<td align="center">2</td>
								<td>Xây dựng</td>
								<td><?php echo $fixprice_order['FixpriceGtable']['build_in'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['build_in_not'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['build_out'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['build_out_not'] ?></td>
							</tr>
							<tr>
								<td align="center">3</td>
								<td>Sử dụng</td>
								<td><?php echo $fixprice_order['FixpriceGtable']['use_in'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['use_in_not'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['use_out'] ?></td>
								<td><?php echo $fixprice_order['FixpriceGtable']['use_out_not'] ?></td>
							</tr>					
						</table>
						
						<h3>Hình ảnh:</h3>
						<ul id="p_image_list">
							<?php foreach ($images as $kk => $img):
								
							?>
								<li><a  title="<?php echo $img["ProductImage"]["title"] ?>" href="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" rel="prettyPhoto[p-image]"><img src="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" width="70" height="50" alt="" title="<?php echo $img["ProductImage"]["title"] ?>" /></a>
									<br />
									<?php echo $img["ProductImage"]["title"] ?>
								</li>
								
							<?php endforeach; ?>
						</ul>
					</div>
					
			<!--MISSION AND VISION-->
					
					
					<?php if($product["Product"]["longitude"].$product["Product"]["latitude"] != '') { ?>
						<div class="vitri" style="height:auto;clear:both">
								<h4>Vị trí</h4>
								
								<div id="google-map">
									<div id="map_canvas" style="width:99.6%; height:300px; border:solid 2px #cccccc;"></div>
								</div>
						</div>
					<?php } ?>
					<?php if(!$return_customer) { ?>
						<div class="backstep fillupform" style="width: 100%; clear: both">
						   <a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>"><< Mô tả lại yêu cầu nếu thông tin chưa đúng</a>
						</div>
					<?php } ?>
					
			
			<br />
			
                        
			<?php if($fixprice_order['FixpriceOrder']['state'] == 'NEW_PRODUCT') { ?>
			<h2 class="fix_heading" style="">Chọn hình thức thanh toán</h2>
				<div class="thongtincanho">
				    Chi phí để nhận thông tin thẩm định BĐS này là: <strong style="font-size: 20px"><?php echo $fixprice_order["FixpriceService"]["price"] ?> VNĐ</strong> (<?php echo $fixprice_order["FixpriceService"]["name"] ?>)
				    <br />
				    Quý khách hãy chọn một trong những hình thức bên dưới để thanh toán vơi chúng tôi:
				    <br style="clear:both" />
				    <div class="nganluong_icon_link" onclick="window.location=<?php echo $checkout_link; ?>">
					<h2>1. Thanh toán bằng cổng NganLuong.vn</h2>
					<a href="<?php echo $checkout_link; ?>" target="_blank">
					    <img src="<?php echo $this->Html->url("/img/home/nganluong.png"); ?>" border="0" />
					</a>
					<br />
					(Visa, MasterCard, ATM, ...)
					<div class="button"><a href="<?php echo $checkout_link; ?>">Nhấn vào đây để thanh toán</a></div>
				    </div>
				     <?php if($fixprice_order['FixpriceService']['id'] == 1) { ?>
					<div class="sms_icon_link">
					<h2>2. Thanh toán bằng SMS</h2>
					<p>Để thanh toán dịch vụ thẩm định bằng cách nhắn tin, Quý khách nhắn tin với cú pháp sau đây:</p>
					<br /><p>Nhắn <strong>MNO 000<?php echo $fixprice_order['FixpriceOrder']['id'] ?></strong> gửi về <strong>8683</strong></p>										
				    </div>
				     <?php } ?>
				    <?php if(!$return_customer) { ?>
					<div class="pay_later fillupform " style="padding-left: 10px">
					    <?php echo $this->Form->create('Product', array('url' => array('controller' => 'fixprice_orders', 'action' => 'add_step3')));?>
						    <input style="cursor: pointer" type="submit" class="" name="save_later" value=">> Lưu thông tin yêu cầu và thanh toán sau" />
					    <?php echo $this->Form->end();?>

					</div>
				    <?php } ?>
				</div>
                        <?php } ?>
                       
					
		</div>		
                
                <!--SIDEBARS-->		
		<div class="sidebar" style="display: none">
			
			<!-- <div class="search advanced">
			</div> -->
			<!--CATEGORIES-->
			<?php //echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php //echo $this->element('quickaddbox'); ?>
			<?php //echo $this->element('newprojects'); ?>
			<?php //echo $this->element('whoisonline'); ?>
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