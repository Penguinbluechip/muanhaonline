
<div style="margin-bottom:20px;">
    
    <form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="filter_index">
    
    <h4><?php __('Content Catefory'); ?>:
        <select onchange="document.getElementById('filter_index').submit()" name="filter_cat_id">
            <option value="all"><?php __('All Categories'); ?></option>
            <?php foreach($cats as $c ) {
                $selected = "";
                if($c["ContentCategory"]["id"] == $cat_id)
                {
                    $selected = 'selected="selected"';
                }
            ?>
                <option value="<?php echo $c["ContentCategory"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["ContentCategory"]["name"] ?></option>
            <?php } ?>
        </select>
    </h4>
    
    </form>
    
</div>

