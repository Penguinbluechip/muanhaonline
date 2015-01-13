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
	$('#end_image_form').before('<div class="input file">'+
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
	function changeService(value)
	{
		//alert(value);
		$('#service_description div').css('display', 'none');
		
		$('#service_description_'+value).css('display', 'block');		
	}
</script>

<script type="text/javascript">
	$(function(){
		codeAddress();
		
		$('#ProductCityId, #ProductDistrictId, #ProductStreetId, #ProductHomeNumber').change(function() {
			codeAddress();
		});
		
		//jQuery.validator.addMethod("notEqual", function(value, element, param) {
		//	return this.optional(element) || value != param;
		//}, "Please specify a different (non-default) value");
		//$("#FixpriceOrderAddStep1Form").validate({
		//	rules: {
		//		'data[Product][district_id]': {
		//					notEqual: "0"
		//		},
		//		'data[Product][ward_id]': {
		//					notEqual: "0"
		//		},
		//		'data[Product][home_number]': "required",
		//		'data[Product][street_id]': {
		//					notEqual: "0"
		//		},
		//		//lastname: "required",
		//		//username: {
		//		//	required: true,
		//		//	minlength: 2
		//		//},
		//		//password: {
		//		//	required: true,
		//		//	minlength: 5
		//		//},
		//		//confirm_password: {
		//		//	required: true,
		//		//	minlength: 5,
		//		//	equalTo: "#password"
		//		//},
		//		//email: {
		//		//	required: true,
		//		//	email: true
		//		//},
		//		//topic: {
		//		//	required: "#newsletter:checked",
		//		//	minlength: 2
		//		//},
		//		//agree: "required"
		//	},
		//	messages: {
		//		//ProductName: false,
		//		//lastname: "Please enter your lastname",
		//		//username: {
		//		//	required: "Please enter a username",
		//		//	minlength: "Your username must consist of at least 2 characters"
		//		//},
		//		//password: {
		//		//	required: "Please provide a password",
		//		//	minlength: "Your password must be at least 5 characters long"
		//		//},
		//		//confirm_password: {
		//		//	required: "Please provide a password",
		//		//	minlength: "Your password must be at least 5 characters long",
		//		//	equalTo: "Please enter the same password as above"
		//		//},
		//		//email: "Please enter a valid email address",
		//		//agree: "Please accept our policy"
		//	}
		//});
	});
</script>

<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Thẩm định BĐS - Bước 1: Thông tin khách hàng');
				
				
				
				
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
			<h2>Đăng ký thẩm định giá BĐS</h2>
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
		<div class="left-content fullcol">
                    <div style="margin-left:10px"></div>
		    
			<?php //echo $this->element('checkoutline'); ?>
		    
		    
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
			
                        
<div class="fixpriceOrders form fillupform">
		<?php echo $this->Form->create('FixpriceOrder', array('type' => 'file'));?>
		
		
		<table width="100%" class="table_bds_form">
			<tr>
				<th colspan="2" align="left"><h2 class="first"><?php __('Lựa chọn dịch vụ thẩm định'); ?></h2></th>
			</tr>
			<tr>
				<td width="35%">
					
					<?php						
						echo $this->Form->input('fixprice_service_id', array('label'=>'Lựa chọn dịch vụ', "onchange"=>"changeService(this.value);"));												
					?>
									
				</td>
				<td>
					<?php						
						echo $this->Form->input('fixprice_type_id', array('label'=>'Mục đích thẩm định'));						
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<div id="service_description">
						<?php foreach($fixpriceService_descriptions as $se) { ?>
							<div id="service_description_<?php echo $se['FixpriceService']['id'] ?>">
								<?php echo $se['FixpriceService']['description'] ?>
							</div>
						<?php } ?>
				
					</div>	
				</td>
			</tr>
		</table>
		
		<table width="100%" class="table_bds_form map_left_intro">
			<tr>
				<th align="left"><h2><?php __('Mô tả Bất động sản'); ?></h2></th>				
			</tr>
			<tr>
				<td>
					<?php
						echo $this->Form->input('Product.name', array('label'=>'Tiêu đề', 'class'=>'required'));			
					?>
				</td>				
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<?php
									echo $this->Form->input('Product.city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Địa chỉ', 'class'=>'required'));									
								?>
							</td>
							<td>
								<?php
									echo $this->Form->input('Product.district_id', array("onchange"=>"ajaxFilterProject(this.value);ajaxFilterWard(this.value);ajaxFilterStreet(this.value);", 'label'=>false));
								?>
							</td>
							<td>
								<?php									
									echo $this->Form->input('Product.ward_id', array('label'=>false));
								?>
							</td>							
						</tr>
					</table>
				</td>				
			</tr>
			
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<?php
									echo $this->Form->input('Product.home_number', array('placeholder'=>'Số nhà', 'label'=>false, 'class'=>'required'));
								?>
							</td>
							
							<td>
								<?php									
									echo $this->Form->input('Product.street_id', array('label'=>false, 'class'=>'required'));									
								?>
							</td>
							<td>
								<div class="input text required facade">
									<div class="facade_input"><input type="radio" id="ProductFacade" name="data[Product][facade]" value="Hẻm" <?php if(isset($this->data["Product"]["facade"]) && $this->data["Product"]["facade"] == "Hẻm") echo ' checked="checked"' ?>  <?php if(!isset($this->data["Product"]["facade"])) echo ' checked="checked"' ?> /> Hẻm</div>
									<div class="facade_input"><input type="radio" id="ProductFacade" name="data[Product][facade]" value="Mặt tiền" <?php if(isset($this->data["Product"]["facade"]) && $this->data["Product"]["facade"] == "Mặt tiền") echo ' checked="checked"' ?> /> Mặt tiền</div>						
								</div>
							</td>
							
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					
					<table>
						<tr>
							<td>
								<?php
									echo $this->Form->input('Product.project_id', array("onchange"=>"ajaxProjectAddress(this.value);", 'label'=>'Dự án'));
								?>
							</td>
							
							<td>
								<div id="project_other">
									<?php
										echo $this->Form->input('Product.project_other', array('label'=>false, 'placeholder'=>'Tên dự án'));
									?>
								</div>
							</td>
							
							<td>
								<?php
									echo "<span id='block_hide'>".$this->Form->input('Product.block', array('label'=>false, 'placeholder'=>'Lô'))."</span>";								
								?>								
								
								<?php
									echo $this->Form->input('Product.featured', array("type"=>"hidden",'value'=>'0', 'label'=>'SP đặc biệt'));
								?>
							</td>
							
							
						</tr>
					</table>
				</td>				
			</tr>
			<tr>
				<td>
					
					<table>
						<tr>
							<td>

								<?php			
									echo $this->Form->input('Product.type_id', array("onchange"=>"ajaxFilterCategory(this.value);", 'label'=>'Loại'));					    
								?>
							</td>
							<td>
								<?php				    
									echo $this->Form->input('Product.category_id', array("onchange"=>"ajaxFilterUtility(this.value);", 'label'=>false));
								?>

							</td>
							
							<td>
								<?php									
									echo $this->Form->input('Product.certificate_id', array('label'=>false));
								?>
							</td>
						</tr>
					</table>
				</td>				
			</tr>
			<tr>
				<td>
					
					<table>
						<tr>
							<td>
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
							</td>
							<td>
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
							</td>
							
							
						</tr>
					</table>
				</td>				
			</tr>
		</table>
		
		
		
		
		<div id="ForHouse" class="forhouse">
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
									    
									    
									    
									    <?php echo $this->Form->input('Product.floors', array('label'=>'Tầng')); ?>
									    <br style="clear: both" />
									</div>
									    
									    
									<div class="box_b">
									    
									    <?php echo $this->Form->input('Product.property_area', array('label'=>'Diện tích sử dụng', 'after'=>'(m<sup>2</sup>)')); ?>
									    
									    <div id="dtxd">
										<?php echo $this->Form->input('Product.build_area', array('label'=>'Diện tích xây dựng', 'after'=>'(m<sup>2</sup>)')); ?>
										
									    </div>
									    
									    <?php echo $this->Form->input('Product.build_date', array('label'=>'Thời gian xây', 'placeholder'=>'ngày/tháng/năm','monthNames' => false,
							'dateFormat' => 'DMY',)); ?>
									   
									</div>
									<br style="clear: both" />
						
							</div>
		
		
		<div id="Forland" class="forhouse box_b">
			    <?php
			    
				echo $this->Form->input('Product.used_for', array('label'=>'Mục đích sử dụng'));
				echo $this->Form->input('Product.lot_area', array('label'=>'Diện tích đất', 'after'=>'(m<sup>2</sup>)'));
			    ?>
			    <div class="lot_detail lot_areaz">
				<?php
				    echo $this->Form->input('Product.area_x', array('label'=>'Ngang', 'after'=>'(m)'));
				    echo $this->Form->input('Product.area_y', array('label'=>'Dài', 'after'=>'(m)'));
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
					    echo $this->Form->input('Product.area_back', array('label'=>false, 'after'=>'(m)', 'style'=>'margin-top:0'));
					?>
					
				</div>
			    </div>
			</div>
			<br style="clear:both" />
			
			
			
			
			
			
			
			
			
			
			
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
				echo $this->Form->input('Product.base_cost', array('label'=>'Hoa hồng (%)'));			
				?>
			    </div>
			    
			<div class="price_detail" style="display: none">    
			<?php
			
			echo $this->Form->input('Product.price', array('label'=>'Giá'));
			
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
			    <div class="input text required uutt" id="utility_contain">
				    <label for="ProductsUtility"><?php echo __('Tiện ích'); ?></label>
				    <table>				    
					<?php foreach($cat["Utility"] as $ku => $u) {
						if($ku%4 == 0) echo '<tr>';
					?>			
					    <td style="font-weight: normal"><input <?php if(in_array($u["id"], $uti_array)) echo 'checked'; ?> type="checkbox" name="data[ProductsUtility][][id]" value="<?php echo $u["id"] ?>"> <?php echo $u["name"] ?></td>
					<?php
						if($ku%4 == 3) echo '</tr>';
					} ?>
				    </table>
			    </div>
			<?php } ?>
			
			<div class="input text" id="gtable_contain">
				<h2>Bảng thông tin chi tiết quy hoạch</h2>
				<label for="ProductsUtility"><?php echo __('(đơn vị: m<sup>2</sup>)'); ?></label>
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
				echo $this->Form->input('Product.create_date', array('label'=>'Ngày đăng','monthNames' => false));
				echo $this->Form->input('Product.expire_date', array('monthNames' => false,'label'=>'Ngày hết hạn'));
			    //echo $this->Form->input('build_date', array('label'=>'Thời gian xây'));
			    ?>
			</div>

			
			
			
			
			
			
			
			
<div class="des_img">	
			
			
			
			<?php //echo var_dump($session->read('temp_images')); ?>
			
			
			
			
			<h2>HÌNH ẢNH</h2>
			
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
			
			<div><strong>(Tải hình ảnh - tập tin ảnh JPG/PNG không quá 2MB)</strong></div>
			<div class="image_box_up">
					<div class="input file">					
						<input type="text" id="ProductImageTitle" name="data[ProductImage][0][title]" value="Hồ sơ pháp lý" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][0][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][0][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][0][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][0][filesize]" />
					
					<div class="input file">
						
						<input type="text" id="ProductImageTitle" name="data[ProductImage][1][title]" value="Hình BĐS" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][1][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][1][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][1][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][1][filesize]" />
					
					<div class="input file">
						
						<input type="text" id="ProductImageTitle" name="data[ProductImage][2][title]" value="Đường/Hẻm trước nhà" readonly="readonly" />
						<input type="file" id="ProductImageFilename" name="data[ProductImage][2][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][2][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][2][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][2][filesize]" />
					
					
					
					<div id="end_image_form"><a href="#more_image" onclick="insertImageForm()"><?php __('Thêm ảnh ...'); ?></a></div>
					<?php echo $form->submit('Tải ảnh', array('name'=>'upload', 'onclick'=>"this.form.target='_self';$('#end_image_form').html('Đang tải ảnh. Vui lòng đợi ...');return true;")); ?>
			
			</div>
					
		<br style="clear:both" />
		<h2>MÔ TẢ CHI TIẾT</h2>
		<div class="pdescription">
			<?php echo $this->Form->input('Product.description', array( 'style'=>'width:100%;height:200px', 'label'=>'Mô tả cho sản phẩm'));	 ?>
		</div>
			
</div>			
			
			
			
			
			
		
		
		<div class="map_right_box">
					<!--MAP & INTRO TEXT-->
					<div class="introduction map">
						<div id="google-map">
							<div id="map_canvas" style="width:100%; height:245px"></div>
							<div style="text-align: center;color: #C37B38">(Kéo con trỏ trên bản đồ để chọn vị trí chính xác)</div>
						</div>						
					</div>
					<div style="display:none">
						<?php									
							echo $this->Form->input('Product.longitude');
							echo $this->Form->input('Product.latitude');
										
						?>
					</div>
					
					<!--<button class="ui-state-default ui-corner-all find_location" type="button" onclick="codeAddress()" ><?php __('Tìm trên bàn đồ') ?> >></button>-->
		</div>
		
		
		
		
		
			
		
		
		<br style="clear:both" />
		<input type="submit" class="btsubmit" value="ĐĂNG YÊU CẦU" />
		
		
		
			
	    
		
		<?php echo $this->Form->end();?>
		
		
				
	
</div>

			
			
			
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
	$('#service_description div').css('display', 'none');
	$('#service_description_'+$('#FixpriceOrderFixpriceServiceId').val()).css('display', 'block');
	
	
	if($('#FixpriceOrderFixpriceServiceId').val() == 1 || $(this).val() == 2) {
		$('#FixpriceOrderFixpriceTypeId option[value=3]').css('display','none');
		$('#FixpriceOrderFixpriceTypeId option[value=4]').css('display','none');
		$('#FixpriceOrderFixpriceTypeId option[value=5]').css('display','none');
		if($('#FixpriceOrderFixpriceTypeId').val() > 2)
			$('#FixpriceOrderFixpriceTypeId').val('1');
	}
	$('#FixpriceOrderFixpriceServiceId').change( function() {
		if($(this).val() == 1 || $(this).val() == 2) {			
			$('#FixpriceOrderFixpriceTypeId option[value=3]').css('display','none');
			$('#FixpriceOrderFixpriceTypeId option[value=4]').css('display','none');
			$('#FixpriceOrderFixpriceTypeId option[value=5]').css('display','none');
			if($('#FixpriceOrderFixpriceTypeId').val() > 2)
				$('#FixpriceOrderFixpriceTypeId').val('1');
		}
		else
		{
			$('#FixpriceOrderFixpriceTypeId option[value=3]').css('display','block');
			$('#FixpriceOrderFixpriceTypeId option[value=4]').css('display','block');
			$('#FixpriceOrderFixpriceTypeId option[value=5]').css('display','block');
		}
	});
	
</script>

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