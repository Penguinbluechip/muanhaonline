<script type="text/javascript">
  
    
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
	  var address = $('#ProjectHomeNumber').val()+' '+$('#ProjectStreet').val()+', '+$('#ProjectDistrictId option:selected').text()+', '+$('#ProjectCityId option:selected').text();
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
	      $('#ProjectLongitude').val(po.split(')')[0].split(',')[0].split('(')[1]);
	      $('#ProjectLatitude').val(po.split(')')[0].split(',')[1].split(' ')[1]);
	}
	
	
	

</script>		
		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'projects', 'action'=>'index')), 'title'=>'Dự án');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'projects', 'action'=>'details', $project["Project"]["id"])), 'title'=>$project["Project"]["name"]);
				
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
			<h2>Thông tin dự án</h2>
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
                    <!--PROPERTY DETAILS-->
			<div class="property-detail">
			  <?php if(count($project["ProjectImage"])) { ?>
				<?php echo $this->Html->image("/uploads/project_image/filename/".$project["ProjectImage"][0]["filename"], array('title' => $project["ProjectImage"][0]["title"], 'width'=>'538px', 'height'=>'213px')); ?>
			  <?php } ?>
				<h2><?php echo $project["Project"]["name"] ?></h2>
				<div class="detail-who clear">
				  
					<ul class="detail" style="width:auto">
						<li><span>Địa chỉ:</span><?php echo $project['Project']['home_number']." ".$project['Project']['street'].", ".$project['District']['name'].", " . $project['City']['name']; ?></li>
						<li class='fillupform' style="margin:0;padding:0"><a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'productsByProject', 'filter_project_id'=>$project["Project"]["id"],'project'=>strtolower(Inflector::slug($project["Project"]["name"])))) ?>" class="btsubmit">Xem các BĐS</a></li>
					</ul>
					
					
				</div>
			</div>
			<!--MAP AND LOCATION-->
			<div class="map-location" style="clear:both">
				<h3>Chuyên viên</h3>
				<div class="" style="height:auto">						
						<ul>
							<li>Tên chuyên viên: <strong><?php echo $profile["UserProfile"]["name"] ?></strong></li>
							<li>Địa chỉ: <strong><?php echo $profile["UserProfile"]["address"] ?></strong></li>
							<li>Số điện thoại: <strong><?php echo $profile["UserProfile"]["phone"] ?></strong></li>
							<li>Email: <strong><?php echo $user["email"] ?></strong></li>
						</ul>
					</div>
			</div>
			<!--MAP AND LOCATION-->
			<div class="map-location" style="clear:both">
				<h3>Thông tin dự án</h3>
				<div class="motabds main">						
						<ul>
							<li>Diện tích đất: <strong><?php echo $project["Project"]["lot_area"] ?> m2</strong></li>
							<li>Diện tích sử dụng: <strong><?php echo $project["Project"]["property_area"] ?> m2</strong></li>
							<li>Khuôn viên: <strong><?php echo $project["Project"]["area_x"]."x".$project["Project"]["area_y"] ?> (m2)</strong></li>
							<li>Tỉ lệ sử dụng: <strong><?php echo $project["Project"]["property_percent"] ?>%</strong></li>
							<li>Số tầng: <strong><?php echo $project["Project"]["floors"] ?></strong></li>
							<li>Số căn hộ/tầng: <strong><?php echo $project["Project"]["block_per_floor"] ?></strong></li>
							<li>Thời gian khởi công (dự kiến): <strong><?php echo date('m/Y', strtotime($project["Project"]["build_start"])) ?></strong></li>
							<li>Thời gian hoàn thành (dự kiến): <strong><?php echo date('m/Y', strtotime($project["Project"]["build_end"])) ?></strong></li>
							<li>Ngày khởi công: <strong><?php echo date('d/m/Y', strtotime($project["Project"]["build_start_real"])) ?></strong></li>
							<li>Ngày hoàn thành móng: <strong><?php echo date('d/m/Y', strtotime($project["Project"]["build_base_real"])) ?></strong></li>
							<li>Ngày bàn giao: <strong><?php echo date('d/m/Y', strtotime($project["Project"]["build_end_real"])) ?></strong></li>
							<li>Ngày cấp sổ: <strong><?php echo date('d/m/Y', strtotime($project["Project"]["build_book"])) ?></strong></li>
							<li>Chủ đầu tư: <strong><?php echo $project["Project"]["cdt"] ?></strong></li>
							<li>Đơn vị thi công: <strong><?php echo $project["Project"]["dvtc"] ?></strong></li>
							<li>Đơn vị thiết kế: <strong><?php echo $project["Project"]["dvtk"] ?></strong></li>
							<li>Đơn vị quản lý DA: <strong><?php echo $project["Project"]["dvqlda"] ?></strong></li>
							
						</ul>
					</div>
			</div>
			<!--MAP AND LOCATION-->
			<div class="map-location">
				<h3>Bản đồ và địa điểm</h3>
				<div id="google-map" style="padding:3px;border:solid 2px #ccc">
					<div id="map_canvas" style="width:100%; height:400px"></div>
				</div>
			</div>
			
			<div class="property-desc">
				<h3>Hình ảnh thực tế</h3>
				<div id="" class="property-gallery clear" style="padding-left:0;border:none">
				  <ul>
							<?php
								foreach($images['real'] as $img)
								{						
									?>
										<li class="zoom">
											<a href="<?php echo $this->Html->url("/uploads/project_image/filename/".$img["ProjectImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $img["ProjectImage"]["title"] ?>">
											  <?php echo $this->Html->image("/uploads/project_image/filename/thumb/admin/".$img["ProjectImage"]["filename"], array('title' => $img["ProjectImage"]["title"],'height'=>'75px', 'width'=>'110px')); ?></a>
											
										</li>
									<?php
								}
							?>
				  </ul>
				</div>
			</div>
			
			<div class="property-desc">
				<h3>Hình ảnh phối cảnh, thiết kế, 3D, ...</h3>
				<div id="" class="property-gallery clear" style="padding-left:0;border:none">
				  <ul>
							<?php
								foreach($images['design'] as $img)
								{						
									?>
										<li class="zoom">
											<a href="<?php echo $this->Html->url("/uploads/project_image/filename/".$img["ProjectImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $img["ProjectImage"]["title"] ?>">
											  <?php echo $this->Html->image("/uploads/project_image/filename/thumb/admin/".$img["ProjectImage"]["filename"], array('title' => $img["ProjectImage"]["title"],'height'=>'75px', 'width'=>'110px')); ?></a>
											
										</li>
									<?php
								}
							?>
				  </ul>
				</div>
			</div>
			
			<!--PROPERTY DESCRIPTIONS-->
			<div class="property-desc">
				<h3>Mô tả</h3>
				<?php echo $project["Project"]["description"] ?>
			</div>
			
			
						
			<!--PROPERTY GALLERY-->
			<div class="property-gallery clear">
				<h3>Dự án gần đây</h3>
				<ul>
					<?php foreach($relatedProjects as $p) { ?>
						<li class="zoom"><a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Project"]["name"])))) ?>">
									    
						    <?php if(count($p["ProjectImage"])) { ?>
						      <img src="<?php echo $this->Html->url("/uploads/project_image/filename/thumb/default/".$p["ProjectImage"][0]["filename"]) ?>" width="110" height="75" alt="" title="" />
						    <?php } else { ?>
						      <?php echo $this->Html->image("/img/home/noimage_110x75.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'75', 'width'=>'110')); ?>
						    <?php } ?>
						    
						    </a>
						    
						<h4><?php echo $p["Project"]["name"] ?></h4>
						</li>
					<?php } ?>
					

				</ul>
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
			
			<?php echo $this->element('expertbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
			
			
		</div>

	
	
<script type="text/javascript">
initialize();

<?php if($project["Project"]["longitude"].$project["Project"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $project["Project"]["longitude"] ?>, <?php echo $project["Project"]["latitude"] ?>));
<?php } ?>

</script>
















