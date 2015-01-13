<script type="text/javascript">
	function changeCurrency(id, value, current)
	{
	    $('#currency_control_'+id+' a').attr('class', '');
	    current.setAttribute("class", "active");
	    
	    
	    $('#product-price_'+id).html(value);
	}
	
	function showMap(id, name)
	{
		$('#ajaxmap h2').html(name);
		$.ajax({
		url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "ajaxMap", "admin" => false));?>/'+id,        
		success: function( data ) {
		    if (console && console.log){
		      $("#map_box").html(data);		      
		    }
		  }
		});
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
<div id="mapouter">
	<div id="ajaxmap" class="popup">
		<h2>Bản đồ</h2>
		<div id="map_box" style="height:510px;">Google Map</div>
	</div>
</div>

		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				
				if($city_id)
				{
					$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'products',											 
											 'filter_city_id'=>$city_id,
											 'city'=>strtolower(Inflector::slug($city['City']['name']))
											)),
										'title'=>$city['City']['name']);
									
				}
				
				if($district)
				{
					$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'products',											 
											 'filter_city_id'=>$district['City']['id'],
											 'city'=>strtolower(Inflector::slug($district['City']['name'])),
											 'filter_district_id'=>$district['District']['id'],
											 'district'=>strtolower(Inflector::slug($district['District']['name']))
											)),
										'title'=>$district['District']['name']);
									
				}
				
				if($project_id)
				{
					$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'products',
											 'action'=>'productsByProject',
											 'filter_project_id'=>$project_id,
											 'project'=>strtolower(Inflector::slug($project['Project']['name']))
											)),
										'title'=>$project['Project']['name']);
									
				}
				
				if($cat_id)
				{
					$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>$cat_id,
											 'category'=>strtolower(Inflector::slug($cat['Category']['name']))
											)),
										'title'=>$cat["Category"]["name"]);
									
				}
				
				
				
				foreach($breads as $key => $item) {
			?>
				<?php if($key == count($breads)-1) { ?>
					<label><?php echo $item['title'] ?></label>
				<?php } else { ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a> <span>&nbsp;</span>
				<?php } ?>
			<?php } ?>
			 
		</div>	
		
		<div class="page-title">
			<h2>Danh sách BĐS</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->element('underconstruction'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">
		
		
		<!--LEFT CONTENT-->			
		<div class="left-content">
                    <div style="margin-left:10px"></div>			
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
                        <?php echo $this->element('homerichfilters'); ?>
                        
        <?
	if(!count($products)){
		echo '<div class="property-detail">Không tìm thấy sản phẩm phù hợp</div>';
	}
	foreach ($products as $product):
		$class = null;
	?>
        
        
        <div class="property-detail" id="products_page">
				
				<h2><a href="<?php echo $this->Html->url($product["Product"]["link"]) ?>" title="<?php echo $product['Product']['name']; ?>"><?php echo $product['Product']['sname']; ?></a></h2>
				<div class="detail-who clear">

					<div class="who-post pp">
						<?php if($product["ProductImage"]["filename"] != "") {?>
						<div class="imgout">
							<a  rel="prettyPhoto[p-image<?php echo $product["Product"]["id"] ?>]" href="<?php echo $this->Html->url("/uploads/product_image/filename/".$product["ProductImage"]["filename"]) ?>" title="<?php echo $product['Product']['name']; ?>"><?php echo $this->Html->image("/uploads/product_image/filename/thumb/feature/".$product["ProductImage"]["filename"], array('title' => $product["ProductImage"]["title"])); ?></a>
						</div>
						<?php } else { ?>
						<div class="imgout">
							<a href="<?php echo $this->Html->url($product["Product"]["link"]) ?>" title="<?php echo $product['Product']['name']; ?>"><?php echo $this->Html->image("/img/home/noimage_160x110.jpg", array('title' => "BĐS chưa có hình ảnh")); ?></a>
						</div>
						<?php } ?>
						
						<span class="small_date">Thời gian đăng: <?php echo $product["Product"]["create_date"] ?></span>
						<?php $ward = ''; if(isset($product['Ward']['name'])) $ward = $product['Ward']['name'].", "; ?>
						<?php $street = ''; if(isset($product['Street']['name'])) $street = $product['Street']['name'].", "; ?>
						<h4><?php echo $product['Product']['home_number']." ".$street.$ward.$product['District']['name'].", " . $product['City']['name']; ?></h4>
						
						
						
						<ul class="room">
							<li>Loại: <strong><?php echo $product['Category']['name'] ?></strong></li>
							<li>MLS: <strong># RE0<?php echo $product['Product']['id'] ?></strong></li>
							<li>Cần: <strong><?php $fors = array("s"=>__('Bán', true),"l"=> __('Cho thuê', true),"m"=> __('Cần mua', true));echo $fors[$product['Product']['for']]; ?></strong></li>
							<?php if($product['Type']['id'] != 3) { ?>
							  <li>DT xây dựng: <strong><?php echo $product['Product']['property_area'] ?>m<sup>2</sup></strong></li>
							<?php } else { ?>
							  <li>Diện tích: <strong><?php echo $product['Product']['lot_area'] ?>m<sup>2</sup></strong></li>
							<?php } ?>							
						</ul>
						<?php //echo $product["Product"]["description"] ?>
						
						
					</div>
					<div id="product_detail_right_box">
						<?php if($product['Product']['price']) { ?>
							<span class="pprice" id="product-price_<?php echo $product["Product"]["id"] ?>"><?php echo $product["prices"][$product["CurrencyPrice"]["id"]]["value"]; ?>&nbsp;</span>
							<br /><span class='currency_control' style="float: none" id="currency_control_<?php echo $product["Product"]["id"] ?>">
								<?php $cc = 0; foreach($product["prices"] as $kk => $cu) { ?>
									<?php if($cc != 0) echo "|"; ?> <a href="#chang_cur" class='<?php echo $cu['id'] == $product["CurrencyPrice"]["id"] ? 'active' : ''; ?>' onclick="changeCurrency('<?php echo $product["Product"]["id"] ?>', '<?php echo $cu["value"] ?>', this)"><?php echo $cu["code"] ?></a>
								<?php $cc++; } ?>
							</span>
						<?php } else { ?>
							<span class="pprice">giá thương lượng &nbsp;</span>
						<?php } ?>
						<br />
						<?php if($user) { ?>
							<?php if(!$product["isFavorite"]) { ?>
								<a class="itemcontrol tool_save" title="Thêm <?php echo $product['Product']['name']; ?> vào lưu trữ" href="<?php echo $this->Html->url(array('controller'=>'favorites', 'action'=>'addFavorite', $product["Product"]["id"])) ?>" style="float:right;margin-top:5px">
									<span>Lưu tin</span>
								      </a>
							<?php } else { ?>
								<a class="itemcontrol tool_remove" title="Bỏ <?php echo $product['Product']['name']; ?> khỏi lưu trữ" href="<?php echo $this->Html->url(array('controller'=>'favorites', 'action'=>'removeFavorite', $product["Product"]["id"])) ?>" style="float:right;margin-top:5px">
									<span>Hủy lưu</span>
								      </a>
							<?php } ?>
						<?php } ?>
						<a class="itemcontrol poplight tool_map" title="Bản đồ: <?php echo $product['Product']['name']; ?>" onclick="showMap('<?php echo $product['Product']['id']; ?>', '<?php echo $product["Product"]["sname"]; ?>')"  rel="ajaxmap" href="#?w=409" style="float:right;margin-top:5px">
							<span>Bản đồ</span>
						      </a>
						      
                                                <a class="itemcontrol tool_view" title="Xem chi tiết: <?php echo $product['Product']['name']; ?>" href="<?php echo $this->Html->url($product["Product"]["link"]) ?>" style="float:right;margin-top:5px">
  <span>Xem chi tiết</span>
</a>

						
					</div>
				</div>
	</div>
        
        
        <?php endforeach; ?>

                        
                        
			<div class="list-share clear paging">
				<ul>
					
					<li class="bubble">
                                            <?php echo $this->Paginator->prev('<< ' . __('trang trước', true), array(), null, array('class'=>'disabled'));?>
                                        </li>
					<li><?php echo $this->Paginator->numbers(array('separator'=>' '));?></li>
					
					<li class="bubble">
                                            <?php echo $this->Paginator->next(__('trang sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                                        </li>

				</ul>
				<ul><li><li>
					
					<label>
                                        <?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page%/%pages%, hiển thị %start% - %end% trong %count% BÐS', true)
	));
	?>
                                        </label></li></li></ul>
			</div>
			
			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			<?php //echo $this->render('_home_filter', '');?>
			<div class="search advanced">
				

					<?php echo $this->render('_home_filter', '');?>
					<?php //echo $this->render('_type_category', '');?>
					

			</div>
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
			
		</div>

	
	

















