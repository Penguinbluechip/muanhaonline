<script type="text/javascript">
	

    function ajaxFilterDistrict(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductDistrictId").html(data);
	      //alert($("#ProductDistrictId").val());
	      ajaxFilterProject($("#ProductDistrictId").val());
            }
          }
        });
    }
    
    function ajaxFilterProject(district_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductProjectId").html(data);
	      ajaxProjectAddress($("#ProductProjectId").val())
            }
          }
        });
    }
    
    function ajaxFilterCategory(type_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "categories", "action" => "ajaxCategoryOption", "admin" => false));?>/'+type_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductCategoryId").html(data);
            }
          }
        });
    }
    
    function ajaxProjectAddress(project_id)
    {
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
    
    var i = 3;
    function insertImageForm()
    {
	$('#end_image_form').before('<div class="input file"><label for="ProductImageFilename">Filename</label>'+
					'<input type="file" id="ProductImageFilename" name="data[ProductImage]['+i+'][filename]"></div>'+
					'<input type="hidden" id="ProductImageDir" name="data[ProductImage]['+i+'][dir]" />'+
					'<input type="hidden" id="ProductImageMimetype" name="data[ProductImage]['+i+'][mimetype]" />'+
					'<input type="hidden" id="ProductImageFilesize" name="data[ProductImage]['+i+'][filesize]" />');
				    
				    
				    
				    
	i++;
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

<h2 style="clear:both"><?php __('Add New Product');?></h2>

<table>
	<tr>
		<td width="36%">
			<div class="products form product_form">
				<?php echo $this->Form->create('Product', array('type' => 'file'));?>
			<!-- Tabs -->
	
		<div id="tabs">

			<ul>
				<li><a href="#tabs-1">Map</a></li>
				<li><a href="#tabs-2">Details</a></li>
				<li><a href="#tabs-3">Description</a></li>
				<li><a href="#tabs-4">Owner</a></li>
				<li><a href="#tabs-5">Images</a></li>
			</ul>
			
			
			

	<div id="tabs-1">
		
		<?php
			echo $this->Form->input('name');
			
			?>
			<div class="input text required">
				<label for="ProductFor"><?php echo __('For'); ?></label>
				
				<select id="ProductFor" name="data[Product][for]">
					<?php
					$fors = array(array("s", __('Sales', true)),array("l", __('Leasing', true)));
					foreach($fors as $f)
					{
						$selected = '';
						if($this->data["Product"]["for"] == $f[0])
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
			
			echo $this->Form->input('type_id', array("onchange"=>"ajaxFilterCategory(this.value);"));
			echo $this->Form->input('category_id');
			echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);"));
			echo $this->Form->input('district_id', array("onchange"=>"ajaxFilterProject(this.value);"));
			echo $this->Form->input('project_id', array("onchange"=>"ajaxProjectAddress(this.value);"));
			echo "<span id='block_hide'>".$this->Form->input('block')."</span>";
			echo $this->Form->input('home_number');
			echo $this->Form->input('street');
			
			echo $this->Form->input('longitude');
			echo $this->Form->input('latitude');
			
			?>
			<button class="ui-state-default ui-corner-all find_location" type="button" onclick="codeAddress()" ><?php __('Find Location') ?> >></button>
			<?php
				echo $this->Form->input('featured', array("type"=>"checkbox"));
				echo $this->Form->input('published', array("type"=>"checkbox", 'checked'=>'checked'));
			?>
			
			
		
	</div>
	
	
	<div id="tabs-2">	
		
			
			
			<?php
			echo $this->Form->input('certificate_id');
			
			
			?>
			<div class="input text required">
				<label for="ProductBedrooms"><?php echo __('Bedrooms'); ?></label>
				
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
			<?php
			
			?>
			<div class="input text required">
				<label for="ProductBathrooms"><?php echo __('Bathrooms'); ?></label>
				
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
			<?php
			
			?>
			<div class="input text required">
				<label for="ProductDirection"><?php echo __('Direction'); ?></label>
				
				<select id="ProductDirection" name="data[Product][direction]">
					<?php
					$directions = array(array("e", __("East", true)),array("w", __("West", true)),array("s", __("South", true)),array("n", __("North", true)),array("es", __("ES", true)),array("en", "EN"),array("ws", __("WS", true)),array("wn", __("WN", true)),array("0", __("Other", true)));
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
			
			echo $this->Form->input('property_area');
			echo $this->Form->input('lot_area');
			
			?>
			<div class="input text required">
				<label for="ProductFloor"><?php echo __('Floors'); ?></label>
				
				<select id="ProductFloors" name="data[Product][floors]">
					<?php
					$floors = array(array("1", "1"),array("1.5", "one and half"),array("2", "2"),array("3", "3"),array("4", "4"),array("5", "5"),array("gt5", 'more than 5'));
					foreach($floors as $f)
					{
						$selected = '';
						if($this->data["Product"]["floors"] == $f[0])
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
			
			
			echo $this->Form->input('price');
			
			?>
			<div class="input text required">
				<label for="ProductPriceCurrency"><?php echo __('Price Currency'); ?></label>
				
				<select id="ProductPriceCurrency" name="data[Product][price_currency]">
					<?php
					foreach($currencies as $c)
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
					?>
				</select>
			</div>
			<?php		
			
			echo $this->Form->input('price_perm2', array("type"=>"checkbox"));
			echo $this->Form->input('commission');
			
			?>
			<div class="input text required">
				<label for="ProductCommissionCurrency"><?php echo __('Commission Currency'); ?></label>
				
				<select id="ProductCommissionCurrency" name="data[Product][commission_currency]">
					<option value="0" <?php if($this->data["Product"]["commission_currency"] == 0){echo $selected = ' selected="selected "';} ?>>%</option>
					<?php
					foreach($currencies as $c)
					{
						$selected = '';
						if($this->data["Product"]["commission_currency"] == $c["CurrencyPrice"]["id"])
						{
							$selected = ' selected="selected "';
						}
						?>
						<option value="<?php echo $c["CurrencyPrice"]["id"]; ?>"<?php echo $selected ?>><?php echo $c["CurrencyPrice"]["code"]; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<?php			
			
			echo $this->Form->input('expire_date');
			echo $this->Form->input('create_date');
			echo $this->Form->input('build_date');
		?>

	</div>
	
	
	<div id="tabs-3">
					
			<?php echo $this->Form->input('description', array( 'style'=>'width:100%;height:400px'));	 ?>
					

	</div>
	
	
	<div id="tabs-4">	
					
			<?php echo $this->Form->input('owner_name');?>
			<?php echo $this->Form->input('owner_name_privacy', array('type'=>'checkbox','checked'=>true));?>
			<?php echo $this->Form->input('owner_phone');?>
			<?php echo $this->Form->input('owner_phone_privacy', array('type'=>'checkbox','checked'=>true));?>
			<?php echo $this->Form->input('occupant_type_id');?>
			<?php echo $this->Form->input('occupant_name');?>
			<?php echo $this->Form->input('occupant_name_privacy', array('type'=>'checkbox','checked'=>true));?>
			<?php echo $this->Form->input('occupant_phone');?>
			<?php echo $this->Form->input('occupant_phone_privacy', array('type'=>'checkbox','checked'=>true));?>
					

	</div>
	
	
	<div id="tabs-5">	
					
					<div class="input file">
						<label for="ProductImageFilename">Filename</label>
						<input type="file" id="ProductImageFilename" name="data[ProductImage][0][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][0][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][0][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][0][filesize]" />
					
					<div class="input file">
						<label for="ProductImageFilename">Filename</label>
						<input type="file" id="ProductImageFilename" name="data[ProductImage][1][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][1][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][1][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][1][filesize]" />
					
					<div class="input file">
						<label for="ProductImageFilename">Filename</label>
						<input type="file" id="ProductImageFilename" name="data[ProductImage][2][filename]">
					</div>
					<input type="hidden" id="ProductImageDir" name="data[ProductImage][2][dir]" />
					<input type="hidden" id="ProductImageMimetype" name="data[ProductImage][2][mimetype]" />
					<input type="hidden" id="ProductImageFilesize" name="data[ProductImage][2][filesize]" />
					
					<div id="end_image_form"><a href="#more_image" onclick="insertImageForm()"><?php __('Add More ...'); ?></a></div>
					
					
					
						
				
					
					

	</div>
	
	
	


					
				</div>

			<?php echo $this->Form->end(__('Add Product', true));?>
			</div>
		</td>
		<td width="64%">
		
			
			<div id="google-map">
				<div id="map_canvas" style="width:100%; height:600px"></div>
			</div>
			
		</td>
	</tr>
</table>


			
<!--
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Products', true), array('action' => 'index'));?></li>
		
	</ul>
</div>
-->
<script type="text/javascript">
ajaxProjectAddress('<?php echo $this->data["Product"]["project_id"] != "" ? $this->data["Product"]["project_id"] : 0 ?>');


//Goodle Map
initialize();
</script>