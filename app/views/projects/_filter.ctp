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
<h3>Tìm kiếm dự án</h3>

<form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="filter">




<table style="width:auto">
    <tr>
	<th><label for="CityId"><?php __('Từ khóa'); ?></label></th>
        <th><label for="CityId"><?php __('Tỉnh/Thành'); ?></label></th>
        <th><label for="DistrictId"><?php __('Quận/Huyện'); ?></label></th>
	<th></th>
        
    </tr>
    <tr>
	<td><input type="text" name="filter_keyword1" class="large" value="<?php echo $keyword; ?>" /></td>
        <td>
            <div class="input select required">    
                <select id="CityId" name="filter_city_id1" onchange="ajaxFilterDistrict(this.value);">
                    <option value="0">- <?php echo __("choose one"); ?> -</option>
                        <?php foreach($cities as $c ) {
                            $selected = "";
                            if($c["City"]["id"] == $city_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["City"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["City"]["name"] ?></option>
                        <?php } ?>
                </select>
	    </div>
        </td>
        <td>
            <div class="input select required">
                <select id="DistrictId" name="filter_district_id1" onchange="ajaxFilterProject(this.value);">
                    <option value="0">- <?php echo __("choose one"); ?> -</option>
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
            </div>
        </td>
	<td><input type="submit" value="Search" /></td>
        
        
    </tr>
</table>



           
	    

</form>