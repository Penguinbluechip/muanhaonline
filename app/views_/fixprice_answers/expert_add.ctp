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

<div class="fixpriceAnswers form">
<?php echo $this->Form->create('FixpriceAnswer', array('url'=>array('controller'=>'fixprice_answers', 'action'=>'add', $fixprice_order_id)));?>

	<fieldset>
		<legend>Thông tin Yêu cầu thẩm định</legend>
			<!--ABOUT INTRO TEXT-->
					
					
					<!--MEET OUR TEAM-->
					<div class="motabds">
						<h3 style="clear: both">Mô tả BĐS:</h3>
						
						<ul>
							<li style="width: 100%">
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
							<li>Loại đường: <strong><?php $fors  = array("m"=>__("đường chính", true),"p"=>__("đường nội bộ", true));if(isset($product['Product']['street_type'])) echo $fors[$product['Product']['street_type']]; ?></strong></li>
							<?php if(isset($product['Product']['street_width'])) { ?>
							  <li>Độ rộng hẻm (nếu có): <strong><?php echo $product['Product']['street_width'] ?>m</strong></li>
							<?php } ?>
							<li>Hình thức: <strong><?php $fors = array("s"=>__('Bán', true),"l"=> __('Cho thuê', true),"m"=> __('Cần mua', true));echo $fors[$product['Product']['for']]; ?></strong></li>
							
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
							  &nbsp;&nbsp;(<?php echo $product['Product']['lot_area'] ?>m2)</strong></li>
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
						<h3 style="clear: both">Các tiện ích: </h3>						
						<ul style="margin-left: 20px">
						  <?php $p = 0;foreach($pus as $k => $pu) { if($pu["ProductsUtility"]["value"] == 1) { ?>
						    <li class="pu_item"><?php echo $pu["Utility"]["name"] ?></li>
						  <?php } $p++; } ?>
						</ul>
						<?php if (!$p) echo '<div style="margin-left: 20px" class="pu_item">(trống)</div>'; ?>
						
						
						
						<h3 style="clear: both">Hình ảnh:</h3>
						<ul id="p_image_list">
							<?php foreach ($images as $kk => $img):
								if($kk) {
							?>
								<li><a  title="<?php echo $img["ProductImage"]["title"] ?>" href="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" rel="prettyPhoto[p-image]"><img src="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" width="70" height="50" alt="" title="<?php echo $img["ProductImage"]["title"] ?>" /></a>
									<br />
									<?php echo $img["ProductImage"]["title"] ?>
								</li>
								
							<?php } endforeach; ?>
						</ul>
					</div>
					
			<!--MISSION AND VISION-->
					
					
					<?php if($product["Product"]["longitude"].$product["Product"]["latitude"] != '') { ?>
						<div class="vitri" style="height:auto;clear:both">
								<h3 style="clear: both">Vị trí:</h3>
								
								<div id="google-map">
									<div id="map_canvas" style="width:100%; height:400px;margin-bottom: 0;"></div>
								</div>
						</div>
					<?php } ?>
					
			
			<br />
	</fieldset>
	

	<fieldset>
		<legend><?php __('Đánh giá BĐS'); ?></legend>
	<?php
		//echo $this->Form->input('fixprice_order_id', array('type'=>'hidden'));
		echo $this->Form->input('price_total', array('label'=>'Tổng giá (VNĐ)'));
		echo $this->Form->input('price_unit', array('label'=>'Đơn giá (VNĐ)'));
		echo $this->Form->input('description', array('label'=>'Đánh giá BĐS', 'style'=>'width:100%; height: 300px'));
		echo $this->Form->input('relate_items', array('label'=>'Thông tin TSSS', 'style'=>'width:100%; height: 300px'));
	?>
		<div class="input text" id="gtable_contain">
				<?php echo $this->Form->input('FixpriceGtable.id', array('type'=>'hidden')); ?>
				<label for="ProductsUtility"><strong><?php echo __('Bảng thông tin thu thập'); ?></strong></label>
				<br />
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
						<td><?php echo $this->Form->input('FixpriceGtable.ground_in', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.ground_in_not', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.ground_out', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.ground_out_not', array('label'=>'')); ?></td>
					</tr>
					<tr>
						<td align="center">2</td>
						<td>Xây dựng</td>
						<td><?php echo $this->Form->input('FixpriceGtable.build_in', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.build_in_not', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.build_out', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.build_out_not', array('label'=>'')); ?></td>
					</tr>
					<tr>
						<td align="center">3</td>
						<td>Sử dụng</td>
						<td><?php echo $this->Form->input('FixpriceGtable.use_in', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.use_in_not', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.use_out', array('label'=>'')); ?></td>
						<td><?php echo $this->Form->input('FixpriceGtable.use_out_not', array('label'=>'')); ?></td>
					</tr>					
				</table>
			</div>
	</fieldset>
	
	
	
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>

		
		<li><?php echo $this->Html->link(__('Danh sách yêu cầu', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		
	</ul>
</div>

<script type="text/javascript">
//Goodle Map
initialize();
<?php if($product["Product"]["longitude"].$product["Product"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $product["Product"]["longitude"] ?>, <?php echo $product["Product"]["latitude"] ?>));
<?php } ?>
</script>