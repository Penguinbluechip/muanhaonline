<script type="text/javascript">
    function ajaxFilterDistrictCheckbox(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictCheckbox", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#NeedDistrictsTable").html(data);
            }
          }
        });
    }
</script>

		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Đăng ký mua/thuê');
				
				
				
				
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
			<h2>Đăng ký mua/thuê bất động sản</h2>
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
                    <div style="margin-left:10px"></div>			
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
			
                        
			<div class="needs form fillupform">
			    <h4>Vui lòng điền thông tin nhu cầu mua - thuê của bạn vào form thông tin dưới đây.</h4>
			    <?php echo $this->Form->create('Need');?>
				    <?php
					    echo $this->Form->input('name', array('label'=>'Tên nhu cầu'));
					    //echo $this->Form->input('user_id');		
					    //echo $this->Form->input('need_types');
				    ?>
				    
						    <div class="input text required">
					    <label for="NeedFor"><?php echo __('Hình thức'); ?></label>
						    <table id="NeedFor" style="width:200px">				    
							    <tbody>	
								    <?php
									    $fors = array(array("s", __('Mua', true)),array("l", __('Thuê', true)));	
									    foreach($fors as $k => $f) {
									    
									    if($k%3 == 0) echo '<tr>';
									    $checked = '';
									    if(in_array($f[0], explode(',', $this->data["Need"]["for"])))
										    $checked = 'checked="checked"';
								    ?>
									    <td style="font-weight: normal">
										    <input <?php echo $checked ?> type="checkbox" id="NeedNeedTypesc" maxlength="255" name="data[Need][for][<?php echo $f[0] ?>]">
										    <?php echo $f[1] ?>
									    </td>
								    <?php
									    if($k%3 == 2) echo '</tr>';
								    } ?>
							    </tbody>
						    </table>
							    
						    </div>
				    
				    <div id="utility_contain" class="input text required">
					    <label for="NeedNeedTypes">Loại nhu cầu</label>
					    (
					    <a href="#checkAll" onclick="$('#NeedNeedTypes input[type=checkbox]').attr('checked', true)" >chọn hết</a>
					    -
					    <a href="#checkNone" onclick="$('#NeedNeedTypes input[type=checkbox]').attr('checked', false)" >bỏ chọn</a>
					    )
					    <table id="NeedNeedTypes">				    
						    <tbody>	
							    <?php foreach($need_types as $k => $nt) {
								    if($k%3 == 0) echo '<tr>';
								    $checked = '';
								    if(in_array($nt['NeedType']['id'], explode(',', $this->data["Need"]["need_types"])))
									    $checked = 'checked="checked"';
							    ?>
								    <td style="font-weight: normal">
									    <input <?php echo $checked ?> type="checkbox" id="NeedNeedTypesc" maxlength="255" name="data[Need][need_types][<?php echo $nt['NeedType']['id'] ?>]">
									    <?php echo $nt['NeedType']['name'] ?>
								    </td>
							    <?php
								    if($k%3 == 2) echo '</tr>';
							    } ?>
						    </tbody>
					    </table>
				    </div>
				    
				    <div id="utility_contain" class="input text required">
					    <label for="NeedCategories">Loại sản phẩm</label>
					    (
					    <a href="#checkAll" onclick="$('#NeedCategories input[type=checkbox]').attr('checked', true)" >chọn hết</a>
					    -
					    <a href="#checkNone" onclick="$('#NeedCategories input[type=checkbox]').attr('checked', false)" >bỏ chọn</a>
					    )
					    <table id="NeedCategories">				    
						    <tbody>	
							    <?php foreach($categories as $k => $nt) {
								    if($k%3 == 0) echo '<tr>';
								    $checked = '';
								    if(in_array($nt['Category']['id'], explode(',', $this->data["Need"]["categories"])))
									    $checked = 'checked="checked"';
							    ?>
								    <td style="font-weight: normal">
									    <input <?php echo $checked ?> type="checkbox" id="NeedCategoriesc" maxlength="255" name="data[Need][categories][<?php echo $nt['Category']['id'] ?>]">
									    <?php echo $nt['Category']['name'] ?>
								    </td>
							    <?php
								    if($k%3 == 2) echo '</tr>';
							    } ?>
						    </tbody>
					    </table>
				    </div>
				    
				    <?php		
					    echo $this->Form->input('city_id', array('label'=>'Tỉnh/Thành', "onchange"=>"ajaxFilterDistrictCheckbox(this.value);"));
				    ?>
				    
				    <div id="utility_contain" class="input text required">
					    <label for="NeedDistricts">Quận/Huyện</label>
					    (
					    <a href="#checkAll" onclick="$('#NeedDistrictsTable input[type=checkbox]').attr('checked', true)" >chọn hết</a>
					    -
					    <a href="#checkNone" onclick="$('#NeedDistrictsTable input[type=checkbox]').attr('checked', false)" >bỏ chọn</a>
					    )
					    <table id="NeedDistrictsTable">				    
						    <tbody>	
							    <?php foreach($districts as $k => $nt) {
								    if($k%3 == 0) echo '<tr>';
								    $checked = '';
								    if(in_array($nt['District']['id'], explode(',', $this->data["Need"]["districts"])))
									    $checked = 'checked="checked"';
							    ?>
								    <td style="font-weight: normal">
									    <input <?php echo $checked ?> type="checkbox" id="NeedDistricts" maxlength="255" name="data[Need][districts][<?php echo $nt['District']['id'] ?>]">
									    <?php echo $nt['District']['name'] ?>
								    </td>
							    <?php
								    if($k%3 == 2) echo '</tr>';
							    } ?>
						    </tbody>
					    </table>
				    </div>
				    
					
						    <div id="utility_contain" class="input text">
							    <label for="NeedCategories">Giá</label>
							    từ
							    <input type="text" id="NeedPriceFrom" maxlength="255" name="data[Need][price_from]">
							    đến
							    <input type="text" id="NeedPriceTo" maxlength="255" name="data[Need][price_to]">
						    </div>
						    
				    <div class="price_detail">			
							    <?php			
								    echo $this->Form->input('currency_id', array('label'=>'Đơn vị tính'));
							    ?>
							    <div class="inputz text" style="clear: none">
								    <label for="NeedPricePerm2">trên</label>
								    
								    <select id="NeedPricePerm2" name="data[Need][price_perm2]">
									    <?php
									    $pty = array(array("0", __("Tổng diện tích", true)),array("1", __("m2", true)),array("2", __("Tháng", true)));
									    foreach($pty as $f)
									    {
										    $selected = '';
										    if($this->data["Need"]["price_perm2"] == $f[0])
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
						    </div>
				    
					    <div class="input text" style="clear: both">
								<label for=""><?php echo __('Thông tin thanh toán'); ?></label>
								
								<select id="NeedCheckoutType" name="data[Need][checkout_type]">
								    <option value="0">-- chọn --</option>
									<?php
									$pty = array(array("một lần", __("một lần", true)),array("nhiều đợt", __("nhiều đợt", true)));
									foreach($pty as $f)
									{
										$selected = '';
										if($this->data["Need"]["checkout_type"] == $f[0])
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
								<label for=""><?php echo __('Diện tích đất'); ?></label>
								
								<select id="NeedLotArea" name="data[Need][lot_area]">
								    <option value="0">-- chọn --</option>
									<?php
									$pty = array(array("0_50", __("< 50m2", true)),array("50_70", __("50-70m2", true)),array("50_70", __("70-100m2", true)),array("100_0", __("trên 100m2", true)));
									foreach($pty as $f)
									{
										$selected = '';
										if($this->data["Need"]["lot_area"] == $f[0])
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
								<label for=""><?php echo __('Diện tích xây dựng'); ?></label>
								
								<select id="NeedPropertyArea" name="data[Need][property_area]">
								    <option value="0">-- chọn --</option>
									<?php
									$pty = array(array("0_50", __("< 50m2", true)),array("50_70", __("50-70m2", true)),array("50_70", __("70-100m2", true)),array("100_0", __("trên 100m2", true)));
									foreach($pty as $f)
									{
										$selected = '';
										if($this->data["Need"]["property_area"] == $f[0])
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
							    <label for="NeedDirections"><?php echo __('Hướng'); ?></label>
							    <table id="NeedDirections">				    
								    <tbody>	
									    <?php
									    $directions = array(array("e", __("Đông", true)),array("w", __("Tây", true)),array("s", __("Nam", true)),array("n", __("Bắc", true)),array("es", __("Đông Nam", true)),array("en", "Đông Bắc"),array("ws", __("Tây Nam", true)),array("wn", __("Tây Bắc", true)),array("0", __("Khác", true)));
									    foreach($directions as $k => $f)
									    {
											    if($k%4 == 0) echo '<tr>';
											    $checked = '';
											    if(in_array($f[0], explode(',', $this->data["Need"]["directions"])))
												    $checked = 'checked="checked"';
										    ?>
											    <td style="font-weight: normal">
												    <input <?php echo $checked ?> type="checkbox" id="NeedDirectionsc" maxlength="255" name="data[Need][directions][<?php echo $f[0]; ?>]">
												    <?php echo $f[1]; ?>
											    </td>
										    <?php
											    if($k%4 == 3) echo '</tr>';
									    } ?>
								    </tbody>
							    </table>
							    
						    </div>
					    <div class="input text">
								<label for="NeedBedrooms"><?php echo __('Phòng ngủ'); ?></label>
								
								<select id="NeedBedrooms" name="data[Need][bedrooms]">
								    <option value="0">- chọn -</option>
									<?php
									for($i=1; $i < 11; $i++)
									{
										$selected = '';
										if($this->data["Need"]["bedrooms"] == $i)
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
					    echo $this->Form->input('use_time', array('label'=>'Thời gian ở dự kiến (tháng)'));
					    ?><div style="display: none"><?php echo $this->Form->input('create_date');?></div><?php
					    echo $this->Form->input('description', array('label'=>'Ghi chú thêm'));
				    ?>
					<div>
					    <?php	
						    echo $this->Form->input('guest_name', array('label'=>'Tên của bạn'));
						    echo $this->Form->input('guest_phone', array('label'=>'Số điện thoại của bạn'));
						    echo $this->Form->input('guest_email', array('label'=>'Email của bạn'));
					    ?>
					</div>
					<input type="submit" id="btncontact" value="Thêm nhu cầu" name="data[btsend]" class="btsubmit">
					
			    <?php echo $this->Form->end();?>
			    </div>

			
			
			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			<?php //echo $this->render('_home_filter', '');?>
			<div class="search advanced">
				

					<?php
					echo $this->render('_home_filter', '');?>					<?php //echo $this->render('_type_category', '');?>
					

			</div>
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
			
		</div>

	
	































