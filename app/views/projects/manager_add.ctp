<script type="text/javascript">
    function ajaxFilterDistrict(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProjectDistrictId").html(data);
            }
          }
        });
    }
    
    var i = 6;
    function insertImageForm(type)
    {
	$('#end_image_form_'+type).before('<div class="input file"><label for="ProjectImageFilename">Tên hình</label>'+
					'<input type="file" id="ProjectImageFilename" name="data[ProjectImage]['+i+'][filename]"></div>'+
					'<input type="hidden" id="ProjectImageDir" name="data[ProjectImage]['+i+'][dir]" />'+
					'<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage]['+i+'][mimetype]" />'+
					'<input type="hidden" id="ProjectImageType" value="'+type+'" name="data[ProjectImage]['+i+'][type]" />'+
					'<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage]['+i+'][filesize]" />');
				    
				    
				    
				    
	i++;
    }
    
    
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
	  var latlng = new google.maps.LatLng(-34.397, 150.644);
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





<table>
	<tr>
		<td width="35%">
			<div class="projects form product_form">
				<?php echo $this->Form->create('Project', array('type' => 'file'));?>
				
				<div id="tabs">

				    <ul>
					    <li><a href="#tabs-1">Bản đồ</a></li>
					    <li><a href="#tabs-2">Chi tiết</a></li>
					    
				    </ul>
				
				<div id="tabs-1">
				    <table><tr>
					<td width="36%">
					
				    <?php					
						echo $this->Form->input('name', array('label'=>'Tên dự án'));
						echo $this->Form->input('project_category_id', array('label'=>'Loại'));
						echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));
						echo $this->Form->input('district_id', array('label'=>'Quận/Huyện'));						
						echo $this->Form->input('street', array('label'=>'Đường'));
						echo $this->Form->input('home_number', array('label'=>'Số'));
						echo $this->Form->input('longitude');
						echo $this->Form->input('latitude');
						echo $this->Form->input('create_date', array('label'=>'Ngày tạo','monthNames' => false));
					?>				
					
					<button class="ui-state-default ui-corner-all find_location" type="button" onclick="codeAddress()" ><?php __('Xác định vị trí') ?> >></button>
					
					</td>
					<td>
					    <div id="google-map">
						    <div id="map_canvas" style="width:100%; height:600px"></div>
					    <div>
					</td>
				    </tr></table>
				</div>
				<div id="tabs-2">
				    <table><tr>
					<td width="40%">
					
				    <?php					
						echo $this->Form->input('lot_area', array('label'=>'Diện tích đất (m2)'));
						echo $this->Form->input('property_area', array('label'=>'Diện tích sử dụng (m2)'));
						echo $this->Form->input('area_x', array('label'=>'Ngang (m)'));
						echo $this->Form->input('area_y', array('label'=>'Dọc (m)'));						
						echo $this->Form->input('property_percent', array('label'=>'Tỉ lệ sử dụng (%)'));
						echo $this->Form->input('floors', array('label'=>'Số tầng'));
						echo $this->Form->input('block_per_floor', array('label'=>'Số căn hộ trên 1 tầng'));
						
						echo $this->Form->input('build_start', array('label'=>'Ngày khởi công (dự kiến)','monthNames' => false));
						echo $this->Form->input('build_end', array('label'=>'Ngày hoàn thành (dự kiến)','monthNames' => false));
						echo $this->Form->input('build_start_real', array('label'=>'Ngày khởi công','monthNames' => false));
						echo $this->Form->input('build_base_real', array('label'=>'Hoàn thành móng','monthNames' => false));
						echo $this->Form->input('build_end_real', array('label'=>'Ngày bàn giao nhà','monthNames' => false));
						echo $this->Form->input('build_book', array('label'=>'Ngày cấp sổ','monthNames' => false));
						echo $this->Form->input('cdt', array('label'=>'Chủ đầu tư'));
						echo $this->Form->input('dvtc', array('label'=>'Đơn vị thi công'));
						echo $this->Form->input('dvtk', array('label'=>'Đơn vị thiết kế'));
						echo $this->Form->input('dvqlda', array('label'=>'Đơn vị quản lý'));

					?>
					
					    </td>
					    <td>
					    
						<?php echo $this->Form->input('description', array('style'=>'height:500px; width:100%')); ?>
						
						
						<fieldset>
					<legend>Hình ảnh dự án</legend>
					
					<div class="input file">
						<label for="ProjectImageFilename">Tên hình</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][0][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][0][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][0][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][0][filesize]" />
					<input type="hidden" id="ProjectImageType" value="1" name="data[ProjectImage][0][type]" />
					
					<div class="input file">
						<label for="ProjectImageFilename">Tên hình</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][1][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][1][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][1][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][1][filesize]" />
					<input type="hidden" id="ProjectImageType" value="1" name="data[ProjectImage][1][type]" />
					
					<div class="input file">
						<label for="ProjectImageFilename">Tên hình</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][2][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][2][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][2][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][2][filesize]" />
					<input type="hidden" id="ProjectImageType" value="1" name="data[ProjectImage][2][type]" />
					
					<div id="end_image_form_1"><a href="#more_image" onclick="insertImageForm('1')"><?php __('Thêm ...'); ?></a>
					</div>
				    </fieldset>
				    
				    <fieldset>
					<legend>Hình phối cảnh, thiết kế</legend>
					
					<div class="input file">
						<label for="ProjectImageFilename">Filename</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][3][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][3][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][3][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][3][filesize]" />
					<input type="hidden" id="ProjectImageType" value="2" name="data[ProjectImage][3][type]" />
					
					<div class="input file">
						<label for="ProjectImageFilename">Filename</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][4][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][4][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][4][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][4][filesize]" />
					<input type="hidden" id="ProjectImageType" value="2" name="data[ProjectImage][4][type]" />
					
					<div class="input file">
						<label for="ProjectImageFilename">Filename</label>
						<input type="file" id="ProjectImageFilename" name="data[ProjectImage][5][filename]">
					</div>
					<input type="hidden" id="ProjectImageDir" name="data[ProjectImage][5][dir]" />
					<input type="hidden" id="ProjectImageMimetype" name="data[ProjectImage][5][mimetype]" />
					<input type="hidden" id="ProjectImageFilesize" name="data[ProjectImage][5][filesize]" />
					<input type="hidden" id="ProjectImageType" value="2" name="data[ProjectImage][5][type]" />
					
					<div id="end_image_form_2"><a href="#more_image" onclick="insertImageForm('2')"><?php __('Add More ...'); ?></a>
					</div>
				    </fieldset>
			    </td>
		</tr></table>
					
				</div>
				
			    </div>
				
					
				  
				    
				    
				 
				
					   
				
				
				
				    
				  </div>
				
				<?php echo $this->Form->end(__('Submit', true));?>
			</div>
			
			
			
			
		</td>
		
	</tr>
</table>





<!--
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->

<script type="text/javascript">
initialize();
</script>