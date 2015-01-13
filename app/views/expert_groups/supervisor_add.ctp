<script type="text/javascript">
function ajaxFilterDistrict(city_id)
    {
	$('.district_checkboxs input').attr('disabled', 'disabled');
	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictCheckboxDiv", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $('label[for="DistrictDistrict"]').parent().html(data);     
	      
	      $('.district_checkboxs  input').removeAttr('disabled');
            }
          }
        });
    }
</script>

<div class="expertGroups form">
<?php echo $this->Form->create('ExpertGroup');?>
	<fieldset>
		<legend><?php __('Thêm nhóm CTV'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>'Tên nhóm'));
		echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));		
		echo $this->Form->input('District', array('multiple' => 'checkbox', 'class'=>'district_checkboxs', 'label'=>'Quận/Huyện'));
		echo $this->Form->input('User', array('multiple' => 'checkbox', 'label'=>'Thành viên nhóm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Lưu', true));?>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Danh sách nhóm', true), array('action' => 'index'));?></li>
		
	</ul>
	
	<?php echo $this->element('supervisorfixpricesidebar'); ?>
</div>