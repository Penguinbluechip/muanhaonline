<label for="DistrictDistrict">Quận/Huyện</label>
<input id="DistrictDistrict" type="hidden" value="" name="data[District][District]">
				<?php foreach($districts as $k => $nt) { ?>
				
					<div class="district_checkboxs">
						<input type="checkbox" id="DistrictDistrict<?php echo $nt['District']['id'] ?>" value="<?php echo $nt['District']['id'] ?>" name="data[District][District][]">
						<label for="DistrictDistrict<?php echo $nt['District']['id'] ?>"><?php echo $nt['District']['name'] ?></label>
					</div>
				
					<!--<td style="font-weight: normal">
						<input type="checkbox" id="NeedDistricts" maxlength="255" name="data[Need][districts][<?php echo $nt['District']['id'] ?>]">
						<?php echo $nt['District']['name'] ?>
					</td>-->
				<?php } ?>
