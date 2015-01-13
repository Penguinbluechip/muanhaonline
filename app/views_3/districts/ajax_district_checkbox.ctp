                        <tbody>	
				<?php foreach($districts as $k => $nt) {
					if($k%3 == 0) echo '<tr>';
				?>
					<td style="font-weight: normal">
						<input type="checkbox" id="NeedDistricts" maxlength="255" name="data[Need][districts][<?php echo $nt['District']['id'] ?>]">
						<?php echo $nt['District']['name'] ?>
					</td>
				<?php
					if($k%3 == 2) echo '</tr>';
				} ?>
			</tbody>