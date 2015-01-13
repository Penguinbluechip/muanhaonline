<h3>Tìm kiếm doanh nghiệp</h3>

<form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="filter">

<table style="width:auto">
    <tr>
	<td><label for="CityId"><?php __('Tên DN'); ?></label></td>       

	<td><input type="text" name="filter_keyword" class="large" value="<?php echo $keyword; ?>" /></td>
    </tr>

    <tr>
	<td><label for="CityId"><?php __('Loại hình'); ?></label></td>
        <td>
            <div class="input select required">    
                <select id="CityId" name="filter_category_id" style="width:auto">
                    <option value="0">- <?php echo __("Loại hình"); ?> -</option>
                        <?php foreach($cats as $c ) {
                            $selected = "";
                            if($c["CompanyCategory"]["id"] == $company_cat_id)
                            {
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="<?php echo $c["CompanyCategory"]["id"] ?>" <?php echo $selected; ?> ><?php echo $c["CompanyCategory"]["name"] ?></option>
                        <?php } ?>
                </select>
	    </div>
        </td>
        
        
    </tr>
</table>


            <ul>
		<li class="buttons clear"><a onclick="$('#filter').submit();" href="#submit"><span>Tìm kiếm</span></a>
		   <a onclick="" href="<?php echo $this->Html->url(array('controller'=>'companies', 'action'=>'reset')) ?>"><span>Xóa bộ lọc</span></a>
		</li>
	    </ul>
	    

</form>