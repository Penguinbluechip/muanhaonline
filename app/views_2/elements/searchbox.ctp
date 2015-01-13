<script type="text/javascript">
    
    function ajaxFilterDistrict2(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#DistrictId2").html(data);
	      //alert($("#ProductDistrictId").val());
	      ajaxFilterProject2($("#ProductDistrictId").val());
            }
          }
        });
    }
    
    function ajaxFilterProject2(district_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProjectId2").html(data);
	      ajaxProjectAddress2($("#ProductProjectId").val())
            }
          }
        });
    }
    
    function ajaxFilterCategory2(type_id)
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
    
    function ajaxProjectAddress2(project_id)
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

<?php $cats = $this->requestAction('categories/getAll'); ?>

<div id="advance-search" class="popup">
	<h2>Tìm kiếm nâng cao</h2>
	<form action="<?php echo $this->Html->url(array('controller'=>'products','action' => 'index')); ?>" method="POST" id="filter">
		<ul>
			<li><label>Tên BĐS</label> <input type="text" name="filter_keyword" class="large" value="<?php echo $keyword; ?>" /></li>
			<li>

				<label><?php __('Tỉnh/Thành'); ?></label> 				
                                <select class="small" id="CityId2" name="filter_city_id" onchange="ajaxFilterDistrict2(this.value);">
                                    <option value="0"><?php echo __("Tất cả"); ?></option>
                                        <?php foreach($cities as $c ) {
                                            
                                            
                                        ?>
                                            <option value="<?php echo $c["City"]["id"] ?>"><?php echo $c["City"]["name"] ?></option>
                                        <?php } ?>
                                </select>
                                <span><?php __('Quận/Huyện'); ?></span> 				
                                <select class="small" id="DistrictId2" name="filter_district_id" onchange="ajaxFilterProject2(this.value);">
                                    <option value="0"><?php echo __("Tất cả"); ?></option>
                                        <?php foreach($districts as $c ) {                                           
                                            
                                        ?>
                                            <option value="<?php echo $c["District"]["id"] ?>"><?php echo $c["District"]["name"] ?></option>
                                        <?php } ?>
                                </select>
			</li>
                        <li>

				<label><?php __('Dự án'); ?></label> 				
                                <select class="small" id="ProjectId2" name="filter_project_id" onchange="">
                                    <option value="0"><?php echo __("Tất cả"); ?></option>
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
                                <span><?php __('Nhu cầu'); ?></span> 				
                                <select class="small" id="For" name="filter_for" onchange="">
                                    <option value="0">Tất cả</option>
                                    <option value="s"><?php echo __("cần bán"); ?></option>
                                    <option value="l"><?php echo __("cho thuê"); ?></option>
				    <option value="m"><?php echo __("cần mua"); ?></option>
                                </select>
			</li>	
			<li>
                            <input type="hidden" id="ProductPrice" name="filter_product_price" value="-1" class="small" />
                            <label>Giá từ</label> <input type="text" id="PriceFrom" name="filter_price_from" class="small" /> <span>đến</span> <input id="PriceTo" type="text" name="filter_price_to" class="small" /> Tr.Đ</li>
                        <li>

				<label><?php __('Loại'); ?></label> 				
                                <select class="small" id="DistrictId" name="filter_category_id" onchange="">
                                    <option value="0">Tất cả</option>
                                        <?php foreach($cats as $c ) {
                                            
                                        ?>
                                            <option value="<?php echo $c["Category"]["id"] ?>"><?php echo $c["Category"]["name"] ?></option>
                                        <?php } ?>
                                </select>
                                <span><?php __('Diện tích'); ?></span> 				
                                <select class="small" onchange="" name="filter_product_area" id="ProductArea" class="filter_product_area">
                                    <option value="">Tất cả</option>
                                    <option value="-30">&lt;= 30 m2</option>
                                    <option value="30-50">30-50 m2</option>
                                    <option value="50-80">50-80 m2</option>
                                    <option value="80-100">80-100 m2</option>
                                    <option value="100-150">100-150 m2</option>
                                    <option value="150-200">150-200 m2</option>
                                    <option value="200-250">200-250 m2</option>
                                    <option value="250-300">250-300 m2</option>
                                    <option value="300-500">300-500 m2</option>
                                    <option value="500-">&gt;=500 m2</option>
                                </select>
			</li>	
			<li><label><?php __('Phòng ngủ'); ?></label>
                            <select class="small" onchange="" id="ProductBedrooms" name="filter_bedrooms">
                                <option value="">Tất cả</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                            </select>
                            <span><?php __('Phòng tắm'); ?></span>
                            <select class="small" onchange="" id="ProductBathrooms" name="filter_bathrooms">
                                    <option value="">Tất cả</option>
                                    <option value="1">1+</option>
                                    <option value="2">2+</option>
                                    <option value="3">3+</option>
                                    <option value="4">4+</option>
                                    <option value="5">5+</option>
                                </select>
                        </li>	
			

			
		</ul>
		<div class="clear">
			<input type="submit" name="Tìm" value="Tìm" />
			<label class="text">Tìm kiếm thông tin BĐS tương ứng.</label>
		</div>

	</form>
</div>