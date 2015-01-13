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

<h3>Bộ lọc sản phẩm</h3>
<form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="filter">
<table style="width:auto">
    <tr>
	<th><label for="CityId"><?php __('Tên BĐS'); ?></label></th>
        <th><label for="CityId"><?php __('Tỷnh/Thành'); ?></label></th>
        <th><label for="DistrictId"><?php __('Quận/Huyện'); ?></label></th>
        <th><label for="ProjectId"><?php __('Dự án'); ?></label></th>
	<th><label for="CityId"><?php __('Module'); ?></label></th>
        
    </tr>
    <tr>
	<td><input type="text" name="filter_keyword" value="<?php echo $keyword; ?>" /></td>
        <td>
            <div class="input select required">    
                <select id="CityId" name="filter_city_id" onchange="ajaxFilterDistrict(this.value);">
                    <option value="0">- <?php echo __("Tỉnh/Thành"); ?> -</option>
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
            </div>
        </td>
        <td>
            <div class="input select required">    
                <select id="ProjectId" name="filter_project_id" onchange="">
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
            </div>
        </td>
	<td>
            <div class="input select required">    
                <select id="Module" name="filter_module" onchange="">
		    <option value="0">- <?php echo __("Module"); ?> -</option>
		    <option value="featured" <?php echo $module == "featured" ? "selected='selected'" : ''; ?>><?php echo __("Đặc biệt"); ?></option>
                    <option value="top_hit" <?php echo $module == "top_hit" ? "selected='selected'" : ''; ?>><?php echo __("SP Nóng"); ?></option>
		    
		    <option value="top_sale" <?php echo $module == "top_sale" ? "selected='selected'" : ''; ?>><?php echo __("Cần bán"); ?></option>
		    <option value="top_lease" <?php echo $module == "top_lease" ? "selected='selected'" : ''; ?>><?php echo __("Cho thuê"); ?></option>
		    <option value="top_new" <?php echo $module == "top_new" ? "selected='selected'" : ''; ?>><?php echo __("Xem nhiều"); ?></option>
		    
		    
                </select>
            </div>
        </td>
        
    </tr>

<table style="width:auto">
    <tr>
	<th><label for="CityId"><?php __('Giá'); ?></label></th>
	<th><label for="CityId"><?php __('Diện tích'); ?></label></th>
	<th><label for="CityId"><?php __('Loại'); ?></label></th>
	<th><label for="CityId"><?php __('Nhu cầu'); ?></label></th>
	<th><label for="CityId"><?php __('Phòng ngủ'); ?></label></th>
	<th><label for="CityId"><?php __('Phòng tắm'); ?></label></th>
	
    </tr>
    <tr>
	<td>
	    <div class="input select required">    
                <select onchange="" id="ProductPrice" name="filter_product_price">
		    <option value="" <?php echo $price_range == "" ? "selected='selected'" : ''; ?>>Tất cả</option>
		    <option value="-500000000" <?php echo $price_range == "-500000000" ? "selected='selected'" : ''; ?>>Dưới 500Tr. VNĐ</option>
		    <option value="500000000-1000000000" <?php echo $price_range == "500000000-1000000000" ? "selected='selected'" : ''; ?>>500Tr. - 1Tỷ. VNĐ</option>
		    <option value="1000000000-1500000000" <?php echo $price_range == "1000000000-1500000000" ? "selected='selected'" : ''; ?>>1Tỷ. - 1.5Tỷ. VNĐ</option>
		    <option value="1500000000-2000000000" <?php echo $price_range == "1500000000-2000000000" ? "selected='selected'" : ''; ?>>1.5Tỷ. - 2Tỷ. VNĐ</option>
		    <option value="2000000000-3000000000" <?php echo $price_range == "2000000000-3000000000" ? "selected='selected'" : ''; ?>>2Tỷ. - 3Tỷ. VNĐ</option>
		    <option value="3000000000-4000000000" <?php echo $price_range == "3000000000-4000000000" ? "selected='selected'" : ''; ?>>3Tỷ. - 4Tỷ. VNĐ</option>
		    <option value="4000000000-6000000000" <?php echo $price_range == "4000000000-6000000000" ? "selected='selected'" : ''; ?>>4Tỷ. - 6Tỷ. VNĐ</option>
		    <option value="6000000000-8000000000" <?php echo $price_range == "6000000000-8000000000" ? "selected='selected'" : ''; ?>>6Tỷ. - 8Tỷ. VNĐ</option>
		    <option value="8000000000-10000000000" <?php echo $price_range == "8000000000-10000000000" ? "selected='selected'" : ''; ?>>8Tỷ. - 10Tỷ. VNĐ</option>
		    <option value="10000000000-15000000000" <?php echo $price_range == "10000000000-15000000000" ? "selected='selected'" : ''; ?>>10Tỷ. - 15Tỷ. VNĐ</option>
		    <option value="15000000000-20000000000" <?php echo $price_range == "15000000000-20000000000" ? "selected='selected'" : ''; ?>>15Tỷ. - 20Tỷ. VNĐ</option>
		    <option value="20000000000-" <?php echo $price_range == "20000000000-" ? "selected='selected'" : ''; ?>>Trên 20Tỷ. VNĐ</option>
		    <option value="0" <?php echo $price_range == "0" ? "selected='selected'" : ''; ?>>Tùy chọn</option>
		</select>
            </div>	    
	</td>
	<td>
	    <select onchange="" name="filter_product_area" id="ProductArea" class="filter_product_area">
		<option value="">Tất cả</option>
		<option value="-30" <?php echo $area_range == "-30" ? "selected='selected'" : ''; ?>>&lt;= 30 m2</option>
		<option value="30-50" <?php echo $area_range == "30-50" ? "selected='selected'" : ''; ?>>30-50 m2</option>
		<option value="50-80" <?php echo $area_range == "50-80" ? "selected='selected'" : ''; ?>>50-80 m2</option>
		<option value="80-100" <?php echo $area_range == "80-100" ? "selected='selected'" : ''; ?>>80-100 m2</option>
		<option value="100-150" <?php echo $area_range == "100-150" ? "selected='selected'" : ''; ?>>100-150 m2</option>
		<option value="150-200" <?php echo $area_range == "150-200" ? "selected='selected'" : ''; ?>>150-200 m2</option>
		<option value="200-250" <?php echo $area_range == "200-250" ? "selected='selected'" : ''; ?>>200-250 m2</option>
		<option value="250-300" <?php echo $area_range == "250-300" ? "selected='selected'" : ''; ?>>250-300 m2</option>
		<option value="300-500" <?php echo $area_range == "300-500" ? "selected='selected'" : ''; ?>>300-500 m2</option>
		<option value="500-" <?php echo $area_range == "500-" ? "selected='selected'" : ''; ?>>&gt;=500 m2</option>
	    </select>
	</td>
	<td>
            <div class="input select required">    
                <select id="DistrictId" name="filter_category_id" onchange="">
                    <option value="0">- <?php echo __("choose one"); ?> -</option>
                        <?php foreach($cats as $c ) {
                            $selected = "";
                            if($c["Category"]["id"] == $cat_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["Category"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["Category"]["name"] ?></option>
                        <?php } ?>
                </select>
            </div>
        </td>
	<td>
            <div class="input select required">    
                <select id="For" name="filter_for" onchange="">
                    <option value="0" <?php echo $for == "0" ? "selected='selected'" : ''; ?>>- <?php echo __("choose one"); ?> -</option>
		    <option value="s" <?php echo $for == "s" ? "selected='selected'" : ''; ?>><?php echo __("cần bán"); ?></option>
		    <option value="l" <?php echo $for == "l" ? "selected='selected'" : ''; ?>><?php echo __("cho thuê"); ?></option>  
                </select>
            </div>
        </td>
	<td>
	    <div class="input select required">    
                <select onchange="" id="ProductBedrooms" name="filter_bedrooms">
		    <option value="" <?php echo $bedrooms == "" ? "selected='selected'" : ''; ?>>Tất cả</option>
		    <option value="1" <?php echo $bedrooms == "1" ? "selected='selected'" : ''; ?>>1+</option>
		    <option value="2" <?php echo $bedrooms == "2" ? "selected='selected'" : ''; ?>>2+</option>
		    <option value="3" <?php echo $bedrooms == "3" ? "selected='selected'" : ''; ?>>3+</option>
		    <option value="4" <?php echo $bedrooms == "4" ? "selected='selected'" : ''; ?>>4+</option>
		    <option value="5" <?php echo $bedrooms == "5" ? "selected='selected'" : ''; ?>>5+</option>
		</select>
            </div>
	</td>
	<td>
	    <div class="input select required">
		<select onchange="" id="ProductBathrooms" name="filter_bathrooms">
		    <option value="" <?php echo $bathrooms == "" ? "selected='selected'" : ''; ?>>Tất cả</option>
		    <option value="1" <?php echo $bathrooms == "1" ? "selected='selected'" : ''; ?>>1+</option>
		    <option value="2" <?php echo $bathrooms == "2" ? "selected='selected'" : ''; ?>>2+</option>
		    <option value="3" <?php echo $bathrooms == "3" ? "selected='selected'" : ''; ?>>3+</option>
		    <option value="4" <?php echo $bathrooms == "4" ? "selected='selected'" : ''; ?>>4+</option>
		    <option value="5" <?php echo $bathrooms == "5" ? "selected='selected'" : ''; ?>>5+</option>
		</select>                
            </div>
	</td>
    </tr>
    
</table>

            <input type="submit" value="<?php __("Tìm kiếm theo bộ lọc") ?>" />

</form>