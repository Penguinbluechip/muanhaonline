<script type="text/javascript">
	function changeBase(value)
	{
	    if(value != 'ký gởi môi giới')
	    {
		$("#base_cost").css('display', 'none');
	    }
	    else
	    {
		$("#base_cost").css('display', 'block');
	    }
	}

    function ajaxFilterDistrict(city_id)
    {
	$('#ProductDistrictId').attr('disabled', 'disabled');
	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductDistrictId").html(data);
	      //alert($("#ProductDistrictId").val());
	      ajaxFilterProject($("#ProductDistrictId").val());
	      ajaxFilterWard($("#ProductDistrictId").val());
	      ajaxFilterStreet($("#ProductDistrictId").val());
	      
	      $('#ProductDistrictId').removeAttr('disabled');
            }
          }
        });
    }
    
    function ajaxFilterProject(district_id)
    {
	$('#ProductProjectId').attr('disabled', 'disabled');
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductProjectId").html(data);
	      ajaxProjectAddress($("#ProductProjectId").val())
	      
	      $('#ProductProjectId').removeAttr('disabled');
            }
          }
        });
    }
    
    function ajaxFilterWard(district_id)
    {
	$('#ProductWardId').attr('disabled', 'disabled');
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "wards", "action" => "ajaxWardOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductWardId").html(data);
	      
	      $('#ProductWardId').removeAttr('disabled');
            }
          }
        });
    }
    
    function ajaxFilterStreet(district_id)
    {
	$('#ProductStreetId').attr('disabled', 'disabled');
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "streets", "action" => "ajaxStreetOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductStreetId").html(data);
	      
	       $('#ProductStreetId').removeAttr('disabled');
            }
          }
        });
    }
    
    function ajaxFilterCategory(type_id)
    {
	//alert(type_id);
	if(type_id == 3)
	{
	    $("#ForHouse").css('display', 'none');
	    $("#dtxd").css('display', 'none');
	}
	else
	{
	    $("#ForHouse").css('display', 'block');
	    $("#dtxd").css('display', 'block');
	}
	
	if(type_id == 2)
	{
	    $("#Forland").css('display', 'none');
	    $("#dtxd").css('display', 'none');
	}
	else
	{
	    $("#Forland").css('display', 'block');
	    //$("#dtxd").css('display', 'block');
	}
	
	if(type_id == 4)
	{
		$(".lot_detail div").removeClass('required');
		$(".lot_detail div").removeClass('error');
		$(".lot_detail .error-message").remove();
		$("#Forland").css('display', 'none');
	}
	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "categories", "action" => "ajaxCategoryOption", "admin" => false));?>/'+type_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductCategoryId").html(data);
            }
          }
        });
    }
    
    function ajaxFilterUtility(cat_id)
    {	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "utilities", "action" => "ajaxUtilityList", "admin" => false));?>/'+cat_id,        
        success: function( data ) {
            if (console && console.log){
              $("#utility_contain").html(data);
            }
          }
        });
    }
    
    function ajaxProjectAddress(project_id)
    {
	if(project_id == 0)
	{
	    $("#project_other").css('display', 'block');
	}
	else
	{
	    $("#project_other").css('display', 'none');	
	
		$.ajax({
		url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectAddress", "admin" => false));?>/'+project_id,        
		success: function( data ) {
		    if (console && console.log){
		      //$("#ProductCategoryId").html(data);
		      var project = eval('(' + data + ')');
		      //alert(data);
		      if(data != 'false')
		      {
			$("#ProductStreet").val(project.Project.street);
			//alert(project.Project.street_id);
			//$('#ProductStreet').attr('disabled', true);
			$("#ProductHomeNumber").val(project.Project.home_number);
			//$('#ProductHomeNumber').attr('disabled', true);
			$('#block_hide').show();
			
			//Google map
			$("#ProductLongitude").val(project.Project.longitude);
			$("#ProductLatitude").val(project.Project.latitude);
			movePosition(new google.maps.LatLng(project.Project.longitude, project.Project.latitude));
	
			
		      }
		      else
		      {
			$("#ProductStreet").val('');
			//$('#ProductStreet').attr('disabled', false);
			$("#ProductHomeNumber").val('');
			//$('#ProductHomeNumber').attr('disabled', false);
			$('#block_hide').val('');
			$('#block_hide').hide();
			
			//Google map
			$("#ProductLongitude").val('');
			$("#ProductLatitude").val('');
		      }
		    }
		  }
		});
	}
    }
    
    var i = 3;
    function insertImageForm()
    {
	$('#end_image_form').before('<div class="input file"><label for="ProductImageFilename">Tập tin ảnh</label>'+
					'<input type="text" id="ProductImageTitle" name="data[ProductImage]['+i+'][title]" placeholder="Tiêu đề ảnh" />'+
					'<input type="file" id="ProductImageFilename" name="data[ProductImage]['+i+'][filename]"></div>'+
					'<input type="hidden" id="ProductImageDir" name="data[ProductImage]['+i+'][dir]" />'+
					'<input type="hidden" id="ProductImageMimetype" name="data[ProductImage]['+i+'][mimetype]" />'+
					'<input type="hidden" id="ProductImageFilesize" name="data[ProductImage]['+i+'][filesize]" />');
				    
				    
				    
				    
	i++;
    }
    
    
    //edit view addition
    function ajaxDeleteImage(image_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array('controller'=>'product_images', 'action' => 'ajaxdelete'));?>/'+image_id,        
        success: function( data ) {
            if (console && console.log){
              //$("#ProductCategoryId").html(data);
	      if(data == 'true');
	      {
		$('#img_'+image_id).css("display", "none");
	      }
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
	  var address = $('#ProductHomeNumber').val()+' '+$('#ProductStreetId option:selected').text()+', '+$('#ProductDistrictId option:selected').text()+', '+$('#ProductCityId option:selected').text();
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
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Thẩm định BĐS - Bước 2: Mô tả BĐS');

				
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
			<h2>Bước 2: Mô tả thông tin BĐS</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			
			<?php echo $this->element('checkoutline'); ?>
			
			<!--FILLUP FORM-->
			<div class="">
			    
			    
			    <table width="100%" id="table_quick">
	<tr>
		<td>
			<div class="products form product_form product_form_home">


<?php echo $this->Form->create('Product', array('type' => 'file', 'url' => array('controller' => 'fixprice_orders', 'action' => 'add_step2')));?>
			<!-- Tabs -->
	
		<div id="tabs">

			<ul>
				<li><a href="#tabs-1" class="tab_detail_head1">Bản đồ</a></li>
				<li><a href="#tabs-2" class="tab_detail_head2">Chi tiết</a></li>
				<li><a href="#tabs-3">Mô tả & Hình ảnh</a></li>
			</ul>
			
			
			

	<div id="tabs-1">
		<!--MAP & INTRO TEXT-->
			<div class="introduction map">
			<div id="google-map">
				<div id="map_canvas" style="width:100%; height:400px"></div>
			</div>
			
								
			</div>
	
	
	    <button class="ui-state-default ui-corner-all find_location" type="button" onclick="codeAddress()" ><?php __('Tìm trên bàn đồ') ?> >></button>
		
		<?php
			echo $this->Form->input('name', array('label'=>'Tiêu đề','style'=>'width:250px'));
			
			?>
			<div class="input text required" style="display: none">
					<label for="ProductPayStatus"><?php echo __('Loại tin'); ?></label>
					
					<select id="ProductPayStatus" name="data[Product][pay_status]">
						<option value="0">Tin thường</option>						
					</select>
			</div>
			<div class="input text required" style="display: none">
				<label for="ProductFor"><?php echo __('Hình thức'); ?></label>
				
				<select id="ProductFor" name="data[Product][for]">					
						<option value="m">Mua</option>						
				</select>
			</div>
			
			<?php
			echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));
			echo $this->Form->input('district_id', array("onchange"=>"ajaxFilterProject(this.value);ajaxFilterWard(this.value);ajaxFilterStreet(this.value);", 'label'=>'Quận/Huyện'));
			echo $this->Form->input('ward_id', array('label'=>'Phường/Xã'));
			echo $this->Form->input('street_id', array('label'=>'Đường'));
			echo $this->Form->input('home_number', array('label'=>'Số nhà'));
			?>
			
				<!--<div class="input text required">
					<label for="ProductStreetType"><?php echo __('Loại đường'); ?></label>
					
					<select id="ProductStreetType" name="data[Product][street_type]">
						<?php
						$directions = array(array("m", __("đường chính", true)), array("p", __("đường nội bộ", true)));
						foreach($directions as $f)
						{
							$selected = '';
							if(isset($this->data["Product"]["street_type"]) && $this->data["Product"]["street_type"] == $f[0])
							{
								$selected = ' selected="selected "';
							}
							?>
							<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
							<?php
						}
						?>
					</select>
				</div>
				
				<div class="input text">
					<?php						
						echo $this->Form->input('street_width', array('label'=>'Độ rộng hẻm (nếu có)', 'after'=>'(m)'));							
					?>
				</div>-->
				
				<div class="input text required facade">
					<div class="facade_input"><input type="radio" id="ProductFacade" name="data[Product][facade]" value="Hẻm" <?php if(isset($this->data["Product"]["facade"]) && $this->data["Product"]["facade"] == "Hẻm") echo ' checked="checked"' ?>  <?php if(!isset($this->data["Product"]["facade"])) echo ' checked="checked"' ?> /> Hẻm</div>
					<div class="facade_input"><input type="radio" id="ProductFacade" name="data[Product][facade]" value="Mặt tiền" <?php if(isset($this->data["Product"]["facade"]) && $this->data["Product"]["facade"] == "Mặt tiền") echo ' checked="checked"' ?> /> Mặt tiền</div>						
				</div>
			
			<?php
			//var_dump($this->data["FixpriceGtable"]);
			echo $this->Form->input('project_id', array("onchange"=>"ajaxProjectAddress(this.value);", 'label'=>'Dự án'));
			?>
			
			<div id="project_other">
				<?php
					echo $this->Form->input('project_other', array('label'=>'Tên dự án'));
				?>
			</div>
			
			<?php
			echo "<span id='block_hide'>".$this->Form->input('block', array('label'=>'Lô'))."</span>";
			
			//echo $this->Form->input('street', array('label'=>'Tên đường'));
			
			?>
			
			<div style="display:none">
			<?php
			
			
			//echo $this->data["Product"]["longitude"];
			
			echo $this->Form->input('longitude');
			echo $this->Form->input('latitude');
			
			?>
			</div>	
			
			<?php
				echo $this->Form->input('featured', array("type"=>"hidden",'value'=>'0', 'label'=>'SP đặc biệt'));
				
			?>
			<div class="backstep fillupform">
						<a  style="float:right; margin-top: -10px" href="#" onclick='$( "#tabs" ).tabs( "option", "selected", 1 );'>Mô tả BĐS cần thẩm định >></a>
			</div>
		
	</div>
	
	
	<div id="tabs-2">	
		
			<div class="type_detail">
				<div style="float: left">
				    <?php			
					    echo $this->Form->input('type_id', array("onchange"=>"ajaxFilterCategory(this.value);", 'label'=>'Loại'));					    
				    ?>
				</div>
				<div style="float: left" class="pcatid">
				    <?php				    
					    echo $this->Form->input('category_id', array("onchange"=>"ajaxFilterUtility(this.value);", 'label'=>''));
				    ?>
				</div>
			</div>
			<br style="clear:both" />
			
			<?php
			//echo $this->Form->input('used_for', array('label'=>'Mục đích sử dụng'));
			echo $this->Form->input('certificate_id', array('label'=>'Loại giấy tờ'));
			?>
			
			<div class="input text required">
				<label for="ProductPlanning"><?php echo __('Quy hoạch'); ?></label>
				
				<select id="ProductPlanning" name="data[Product][planning]">
					<?php
					$directions = array(array("đã quy hoạch ổn định", __("đã quy hoạch ổn định", true)),array("quy hoạch 1 phần", __("quy hoạch 1 phần", true)),array("quy hoạch toàn bộ", __("quy hoạch toàn bộ", true)),array("khác", __("khác", true)));
					foreach($directions as $f)
					{
						$selected = '';
						if($this->data["Product"]["planning"] == $f[0])
						{
							$selected = ' selected="selected "';
						}
						?>
						<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			
			<div class="input text required">
				<label for="ProductDirection"><?php echo __('Hướng'); ?></label>
				
				<select id="ProductDirection" name="data[Product][direction]">
					<?php
					$directions = array(array("e", __("Đông", true)),array("w", __("Tây", true)),array("s", __("Nam", true)),array("n", __("Bắc", true)),array("es", __("Đông Nam", true)),array("en", "Đông Bắc"),array("ws", __("Tây Nam", true)),array("wn", __("Tây Bắc", true)),array("0", __("Khác", true)));
					foreach($directions as $f)
					{
						$selected = '';
						if($this->data["Product"]["direction"] == $f[0])
						{
							$selected = ' selected="selected "';
						}
						?>
						<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<?php
			?>
			<div id="ForHouse">
			<div class="lot_detail room">
			    <div class="input text required">
				    <label for="ProductBedrooms"><?php echo __('Phòng ngủ'); ?></label>
				    
				    <select id="ProductBedrooms" name="data[Product][bedrooms]">
					    <?php
					    for($i=1; $i < 11; $i++)
					    {
						    $selected = '';
						    if($this->data["Product"]["bedrooms"] == $i)
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>
			    <div class="input text">
				    <label for="ProductLivingRooms"><?php echo __('Phòng khách'); ?></label>
				    
				    <select id="ProductLivingRooms" name="data[Product][living_rooms]">
					    <?php
					    for($i=1; $i < 11; $i++)
					    {
						    $selected = '';
						    if($this->data["Product"]["living_rooms"] == $i)
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>
			
			
			    <div class="input text">
				    <label for="ProductBathrooms"><?php echo __('Phòng tắm'); ?></label>
				    
				    <select id="Bathrooms" name="data[Product][bathrooms]">
					    <?php
					    for($i=1; $i < 11; $i++)
					    {
						    $selected = '';
						    if($this->data["Product"]["bathrooms"] == $i)
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>
			    
			    <div class="input text">
				    <label for="ProductWc"><?php echo __('WC'); ?></label>
				    
				    <select id="ProductWc" name="data[Product][wc]">
					    <?php
					    for($i=1; $i < 11; $i++)
					    {
						    $selected = '';
						    if($this->data["Product"]["wc"] == $i)
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>
			    
			    
			    
			    <?php echo $this->Form->input('floors', array('label'=>'Tầng')); ?>
			    <br style="clear: both" />
			</div>
			    
			    <!--<div class="input text required">
				    <label for="ProductBuildStructure"><?php echo __('Kết cấu xây dựng'); ?></label>
				    
				    <select id="ProductBuildStructure" name="data[Product][build_structure]">
					    <?php
					    $pty = array(array("trệt", __("trệt", true)),array("lửng", __("lửng", true)),array("lầu", __("lầu", true)),array("úp mái", __("úp mái", true)));
					    foreach($pty as $f)
					    {
						    $selected = '';
						    if($this->data["Product"]["build_structure"] == $f[0])
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>-->
			
			    

			    <?php echo $this->Form->input('property_area', array('label'=>'Diện tích sử dụng', 'after'=>'(m<sup>2</sup>)')); ?>
			    
			    <div id="dtxd">
				<?php echo $this->Form->input('build_area', array('label'=>'Diện tích xây dựng', 'after'=>'(m<sup>2</sup>)')); ?>
				
			    </div>
			    
			    <?php echo $this->Form->input('build_date', array('label'=>'Thời gian xây','monthNames' => false)); ?>


			</div>
			
			
			
			<div id="Forland">
			    <?php
			    
				echo $this->Form->input('used_for', array('label'=>'Mục đích sử dụng'));
				echo $this->Form->input('lot_area', array('label'=>'Diện tích đất', 'after'=>'(m<sup>2</sup>)'));
			    ?>
			    <div class="lot_detail lot_areaz">
				<?php
				    echo $this->Form->input('area_x', array('label'=>'Ngang', 'after'=>'(m)'));
				    echo $this->Form->input('area_y', array('label'=>'Dài', 'after'=>'(m)'));
				?>
				
				<div class="area_shape">
					<select id="ProductAreaType" name="data[Product][area_type]">
						    <?php
						    $hau = array(array("Không nở/tóp hậu", __("Không nở/tóp hậu", true)), array("Nở hậu", __("Nở hậu", true)),array("Tóp hậu", __("Tóp hậu", true)));
						    foreach($hau as $f)
						    {
								$selected = '';
								if($this->data["Product"]["area_type"] == $f[0])
								{
									$selected = ' selected="selected "';
								}
								?>
									<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
								<?php
						    }
						    ?>
					</select>
					
					<?php
					    echo $this->Form->input('area_back', array('label'=>false, 'after'=>'(m)'));
					?>
					<br style="clear:both" />
				</div>
			    </div>
			</div>
			
			
			<?php
			
			?>
			    
			    <div class="input text" style="display: none">
				    <label for="ProductBuildBase"><?php echo __('Thông tin cơ bản'); ?></label>
				    
				    <select id="ProductBuildBase" name="data[Product][base]" onchange="changeBase(this.value)">
					<option value="">-- chọn --</option>
					    <?php
					    $pty = array(array("chính chủ", __("chính chủ", true)),array("miễn trung gian", __("miễn trung gian", true)),array("ký gởi môi giới", __("ký gởi môi giới", true)));
					    foreach($pty as $f)
					    {
						    $selected = '';
						    if($this->data["Product"]["base"] == $f[0])
						    {
							    $selected = ' selected="selected "';
						    }
						    ?>
						    <option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
						    <?php
					    }
					    ?>
				    </select>
			    </div>
			    <div id="base_cost" style="display: none">
				<?php
				echo $this->Form->input('base_cost', array('label'=>'Hoa hồng (%)'));			
				?>
			    </div>
			    
			<div class="price_detail" style="display: none">    
			<?php
			
			echo $this->Form->input('price', array('label'=>'Giá'));
			
			?>
			
				<div class="inputz text" style="float:left;clear: none">
					<label for="ProductPriceCurrency"></label>
					
					<select id="ProductPriceCurrency" name="data[Product][price_currency]">
						<?php
						foreach($currencies as $c)
						{
						    if(true)
						    {
							$selected = '';
							if($this->data["Product"]["price_currency"] == $c["CurrencyPrice"]["id"])
							{
								$selected = ' selected="selected "';
							}
							?>
							<option value="<?php echo $c["CurrencyPrice"]["id"]; ?>"<?php echo $selected ?>><?php echo $c["CurrencyPrice"]["code"]; ?></option>
							<?php
						    }
						}
						?>
					</select>
				</div>
				<?php			
				
				?>
				<div class="inputz text" style="float:left;clear: none">
					<label for="ProductPricePerm2"></label>
					
					<select id="ProductPricePerm2" name="data[Product][price_perm2]">
						<?php
						$pty = array(array("0", __("Tổng diện tích", true)),array("1", __("m<sup>2</sup>", true)),array("2", __("Tháng", true)));
						foreach($pty as $f)
						{
							$selected = '';
							if($this->data["Product"]["price_perm2"] == $f[0])
							{
								$selected = ' selected="selected "';
							}
							?>
							<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div>(để trống: giá thương lượng)</div>
			</div>
			
			
			<?php if(true) { ?>
			    <div class="input text required" id="utility_contain">
				    <label for="ProductsUtility"><?php echo __('Tiện ích'); ?></label>
				    <table>				    
					<?php foreach($cat["Utility"] as $ku => $u) {
						if($ku%2 == 0) echo '<tr>';
					?>			
					    <td style="font-weight: normal"><input <?php if(in_array($u["id"], $uti_array)) echo 'checked'; ?> type="checkbox" name="data[ProductsUtility][][id]" value="<?php echo $u["id"] ?>"> <?php echo $u["name"] ?></td>
					<?php
						if($ku%2 == 1) echo '</tr>';
					} ?>
				    </table>
			    </div>
			<?php } ?>
			
			<div class="input text" id="gtable_contain">
				<label for="ProductsUtility"><?php echo __('<strong>Bảng thông tin chi tiết quy hoạch</strong><br />(đơn vị: m<sup>2</sup>)'); ?></label>
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
			
			<div style="display: none">
			    <?php		
				echo $this->Form->input('create_date', array('label'=>'Ngày đăng','monthNames' => false));
				echo $this->Form->input('expire_date', array('monthNames' => false,'label'=>'Ngày hết hạn'));
			    //echo $this->Form->input('build_date', array('label'=>'Thời gian xây'));
			    ?>
			</div>
			<div class="backstep fillupform">
						<a href="#" style="float:right; margin-top: -10px" onclick='$( "#tabs" ).tabs( "option", "selected", 2 );'>Ghi chú & Tải ảnh >></a>
			</div>

	</div>
	
	
	<div id="tabs-3" class="<?php if(true) echo "error-tabs"; ?>">
		<div class="pdescription">
			<?php echo $this->Form->input('description', array( 'style'=>'width:100%;height:200px', 'label'=>'Mô tả cho sản phẩm'));	 ?>
		</div>
			
			<?php //echo var_dump($session->read('temp_images')); ?>
			
			<div id="image-list">
					<?php
						foreach($images as $img)
						{						
							?>
								<div class="image-item" id="img_<?php echo $img["ProductImage"]["id"] ?>">
									<a target="_blank" href="<?php echo $this->Html->url("/uploads/product_image/filename/".$img["ProductImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $img["ProductImage"]["title"] ?>"><?php echo $this->Html->image("/uploads/product_image/filename/thumb/admin/".$img["ProductImage"]["filename"], array('title' => $img["ProductImage"]["title"],'height'=>'50px')); ?></a>
									<br /><?php echo $img["ProductImage"]["title"] ?>
									<br /><a href="#delete_image" onclick="ajaxDeleteImage('<?php echo $img["ProductImage"]["id"]; ?>')"><?php __('Xóa') ?></a>
								</div>
							<?php
						}
					?>
			</div>
			<br style="clear:both" />
			<div class="input file">
			<div><strong>(Tải hình ảnh - tập tin ảnh JPG/PNG không quá 2MB)</strong></div>
						<label for="ProductImageFilename">Tập tin ảnh</label>
						<input type="text" id="ProductImageTitle" name="data[ProductImage][0][title]" value="Hồ sơ pháp lý" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][0][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][0][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][0][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][0][filesize]" />
					
					<div class="input file">
						<label for="ProductImageFilename">Tập tin ảnh</label>
						<input type="text" id="ProductImageTitle" name="data[ProductImage][1][title]" value="Hình BĐS" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][1][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][1][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][1][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][1][filesize]" />
					
					<div class="input file">
						<label for="ProductImageFilename">Tập tin ảnh</label>
						<input type="text" id="ProductImageTitle" name="data[ProductImage][2][title]" value="Đường/Hẻm trước nhà" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][2][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][2][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][2][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][2][filesize]" />
					
					<!--<div class="input file">
						<label for="ProductImageFilename">Tập tin ảnh</label>
						<input type="text" id="ProductImageTitle" name="data[ProductImage][3][title]" placeholder="Tiêu đề ảnh" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][3][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][3][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][3][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][3][filesize]" />-->
					
					<div id="end_image_form"><a href="#more_image" onclick="insertImageForm()"><?php __('Thêm ảnh ...'); ?></a></div>
					<?php echo $form->submit('Tải ảnh', array('name'=>'upload', 'onclick'=>"this.form.target='_self';$('#end_image_form').html('Đang tải ảnh. Vui lòng đợi ...');return true;")); ?>
					
			

	</div>
	
	
	
	
	
	


					
				</div>
				
				<div class="fillupform">
					<input type="submit" class="btsubmit" value="Lưu" />
					
				</div>

			<?php echo $this->Form->end();?>
			</div>
		</td>
		
	</tr>
</table>	
			</div>			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			<!-- <div class="search advanced">
			</div> -->
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
		</div>








			
<script type="text/javascript">
if($('#ProductTypeId').val() == 3)
{
    $("#ForHouse").css('display', 'none');
    $("#dtxd").css('display', 'none');
}

if($('#ProductTypeId').val() == 2)
{
    $("#Forland").css('display', 'none');
     $("#dtxd").css('display', 'none');
}

if($('#ProductTypeId').val() == 4)
{
	$(".lot_detail div").removeClass('required');
	$(".lot_detail div").removeClass('error');
	$(".lot_detail .error-message").remove();
	$("#Forland").css('display', 'none');
}

if($('#ProductBuildBase').val() == 'ký gởi môi giới')
{
    $("#base_cost").css('display', 'block');
}

if($('#ProductProjectId').val() != 0)
{
     $("#project_other").css('display', 'none');
}


//Area Shape
$(".area_shape .input").css('display', 'none');
if($('#ProductAreaType').val() != "Không nở/tóp hậu") { $(".area_shape .input").css('display', 'block'); }
$('#ProductAreaType').change( function(){
	if($(this).val() != "Không nở/tóp hậu") {
		$(".area_shape .input").css('display', 'block');
	} else {
		$(".area_shape .input").css('display', 'none');
	}
});




<?php if(isset($this->data["Product"]["project_id"])) { ?>
ajaxProjectAddress('<?php echo $this->data["Product"]["project_id"] != '' ? $this->data["Product"]["project_id"] : 0 ?>');
<?php } ?>

//Goodle Map
initialize();
<?php if(isset($this->data["Product"]["longitude"]) && isset($this->data["Product"]["latitude"]) && $this->data["Product"]["longitude"].$this->data["Product"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $this->data["Product"]["longitude"] ?>, <?php echo $this->data["Product"]["latitude"] ?>));
<?php } ?>


if($('#tabs-2').find(".error-message").size())
{
	$('.tab_detail_head2').addClass('error-tab');
}

if($('#tabs-1').find(".error-message").size())
{
	$('.tab_detail_head1').addClass('error-tab');
}



</script>