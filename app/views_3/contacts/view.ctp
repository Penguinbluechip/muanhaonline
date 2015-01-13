<script type="text/javascript">
  //Google Maps
    //Google Map
  var geocoder;
  var map;
  var marker;
  var infowindow;
  
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(<?php echo $contact["Contact"]["longitude"] ?>, <?php echo $contact["Contact"]["latitude"] ?>);
	  var myOptions = {
	    zoom: 15,
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



		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a><span>&nbsp;</span><label>Liên hệ</label>
		</div>	
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Liên hệ</h2>
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
			<!--MAP & INTRO TEXT-->
			<div class="introduction map">
				<div id="google-map">
                                    <div id="map_canvas" style="width:534px; height:360px"></div>
                                </div>
                                <!--<iframe width="538" height="360" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Vietnam&amp;sll=12.879721,121.774017&amp;sspn=18.197637,33.815918&amp;g=Vietnam&amp;ie=UTF8&amp;hq=&amp;hnear=Vietnam&amp;ll=12.879721,121.774017&amp;spn=36.095772,67.631836&amp;z=5&amp;output=embed"></iframe>-->
				<?php echo $contact["Contact"]["description"] ?>				
			</div>
			<!--FILLUP FORM-->
			<div class="fillupform">
				<h2>Thông tin</h2>
				<div id="mail_error"><?php echo $error; ?></div>
				<div id="mail_error"><?php echo $sucess; ?></div>
				<form id="cform" action="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', $contact["Contact"]["id"] )) ?>" method="post">
					<ul class="clear contact"> 
						<li>
							<input type="text" name="data[name]" id="name" class="required" />    
							<label for="name"><span>Tên</span> <label for="name" class="error req">(yêu cầu)</label></label>
						</li>
						<li>
							<input type="text" name="data[email]" id="email" class="required email" />    
							<label for="email"><span>Mail ( được bảo mật)</span> <label for="email" class="error req">(yêu cầu)</label></label>
						</li>        
						<li>
							<input type="text" name="data[subject]" id="subject" />   
							<label for="subject">Chủ đề</label>							 
						</li>        
						<li>
							<textarea name="data[message]" rows="5" cols="20" id="message" class="required"></textarea>        
						</li>        
						<li>
							<label>&nbsp;</label>        
							<input class="btsubmit" type="submit" name="data[btsend]" value="Gửi" id="btncontact" />							
						</li>
					 </ul>
				</form> 	
			</div>			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			<!--MORE INFORMATIONS-->
			<div class="more-information">
				<h3>Thông tin liên hệ</h3>
				<ul>
					<li><span>Địa chỉ:</span> <?php echo $contact["Contact"]["address"] ?></li>
					<li><span>ZIP - Tỉnh/Thành:</span> <?php echo $contact["Contact"]["zip"] ?></li>
					<li><span>Email:</span> <a href="#"><?php echo $contact["Contact"]["email"] ?></a></li>
					<li><span>Điện thoại:</span> <?php echo $contact["Contact"]["phone"] ?></li>
                                        <li><span>FAX:</span> <?php echo $contact["Contact"]["fax"] ?></li>	
				</ul>
			</div>
			<!--NEWSLETTER-->
			<?php echo $this->element('registerbox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			
			<?php echo $this->element('whoisonline'); ?>
		</div>

        
<script>

        //Goodle Map
initialize();
<?php if($contact["Contact"]["longitude"].$contact["Contact"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $contact["Contact"]["longitude"] ?>, <?php echo $contact["Contact"]["latitude"] ?>));
<?php } ?>
</script>