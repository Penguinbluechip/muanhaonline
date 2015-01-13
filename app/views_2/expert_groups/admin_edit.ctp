<script type="text/javascript">
function ajaxFilterDistrict(city_id)
    {
	$('.district_checkboxs input').attr('disabled', 'disabled');
	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictCheckboxDiv", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $('.district_checkboxs').parent().html(data);     
	      
	      $('.district_checkboxs  input').removeAttr('disabled');
            }
          }
        });
    }
</script>

<div class="expertGroups form">
<?php echo $this->Form->create('ExpertGroup');?>
	<fieldset>
		<legend><?php __('Admin Edit Expert Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));		
		echo $this->Form->input('District', array('multiple' => 'checkbox', 'class'=>'district_checkboxs'));
		echo $this->Form->input('User', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ExpertGroup.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ExpertGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Expert Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>