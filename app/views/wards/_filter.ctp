
<div style="margin-bottom:20px;">
    
    <form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="filter_index">
    
    <h4><?php __('City'); ?>:
        <select onchange="document.getElementById('filter_index').submit()" name="filter_city_id">
            <option value="all"><?php __('All Cities'); ?></option>
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
    </h4>
    <h4><?php __('District'); ?>:
        <select onchange="document.getElementById('filter_index').submit()" id="DistrictId" name="filter_district_id">
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
    </h4>
    </form>
    
</div>

