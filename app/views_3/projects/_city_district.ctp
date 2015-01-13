<script type="text/javascript">
    function filterDistricts(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProjectDistrictId").html(data);
            }
          }
        });        
    }
</script>

<div class="input select required">
    <label for="CityId"><?php __('City'); ?></label>
    <select id="CityId" name="city_id" onchange="filterDistricts(this.value);">
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
