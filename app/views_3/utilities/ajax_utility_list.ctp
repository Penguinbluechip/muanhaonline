<label for="ProductsUtility"><?php echo __('Tiện ích'); ?></label>
<?php if (count($cat["Utility"])) {?>
				    <table>				    
				    <?php foreach($cat["Utility"] as $ku => $u) {
				    if($ku%4 == 0) echo '<tr>';
				    ?>			
					    <td style="font-weight: normal"><input type="checkbox" name="data[ProductsUtility][][id]" value="<?php echo $u["id"] ?>"> <?php echo $u["name"] ?></td>
				    <?php
				    if($ku%4 == 3) echo '</tr>';
				    } ?>
				    </table>
<?php } else { ?>
    (trống)
<?php } ?>