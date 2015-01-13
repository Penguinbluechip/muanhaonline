

<script type="text/javascript">
    
    function ajaxFilterDistrict(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#DistrictId").html(data);
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
              $("#ProjectId").html(data);
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
</script>




<form action="<?php echo $this->Html->url(array('controller'=>'products','action' => 'index')); ?>" method="POST" id="filter">




<!--SEARCH PROPERTIES-->
			<div class="search">
				<h3>Tìm kiếm bất động sản</h3>
				
					<ul>
						<li><label>Tìm</label> <input type="text"  name="filter_keyword" value="<?php echo $keyword; ?>" class="large" /></li>
						
						<li style="margin-left:33px">
						    <select id="CityId" name="filter_city_id" onchange="ajaxFilterDistrict(this.value);">
                    <option value="0">- <?php echo __("Tỉnh/Thành"); ?> -</option>
                        <?php foreach($cities as $c ) {
                            $selected = "";
                            if(isset($city_id) && $c["City"]["id"] == $city_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["City"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["City"]["name"] ?></option>
                        <?php } ?>
                </select>
						<select id="DistrictId" name="filter_district_id" onchange="ajaxFilterProject(this.value);">
                    <option value="0">- <?php echo __("Quận/Huyện"); ?> -</option>
                        <?php foreach($districts as $c ) {
                            $selected = "";
                            if($c["District"]["id"] == $district_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["District"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["District"]["name"] ?></option>
                        <?php } ?>
                </select>
						</li>
						<li style="margin-left:33px">
						    <select id="ProjectId" name="filter_project_id" onchange="" style="width:auto !important;">
                    <option value="0">- <?php echo __("Dự án"); ?> -</option>
                        <?php foreach($projects as $c ) {
                            $selected = "";
                            if($c["Project"]["id"] == $project_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["Project"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["Project"]["name"] ?></option>
                        <?php } ?>
                </select>
						    
						</li>
						
						<!--<li><label>Giá</label> <input type="text" name="from" class="small" /> <label class="to">đến</label> <input type="text" name="to" class="small" /></li>-->

						<!--<li><label>Phòng ngủ</label> <input type="text" name="beds" class="xsmall" /> <label>Phòng tắm</label> <input type="text" name="baths" class="xsmall" /> <label>Garage</label> <input type="text" name="garage" class="xsmall" /></li>-->
						<li class="buttons clear"><a href="#submit" onclick="$('#filter').submit();"><span>Tìm kiếm</span></a>
						    <a href="#?w=409" rel="advance-search" class="poplight"><span>Tìm kiếm nâng cao</span></a></li>
					</ul>

			</div>



</form>