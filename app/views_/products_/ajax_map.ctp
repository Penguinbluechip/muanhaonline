
							<div id="google-map">
								<div id="map_canvas" style="width:571px; height:500px; border:solid 2px #cccccc;"></div>
							</div>

<script type="text/javascript">
//Goodle Map
initialize();
<?php if($product["Product"]["longitude"].$product["Product"]["latitude"] != '') { ?>
movePosition(new google.maps.LatLng(<?php echo $product["Product"]["longitude"] ?>, <?php echo $product["Product"]["latitude"] ?>));
<?php } ?>
</script>
