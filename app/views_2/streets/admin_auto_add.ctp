<script type="text/javascript">
	function ajaxFilterDistrict(city_id)
	{
		$.ajax({
		url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
		success: function( data ) {
		    if (console && console.log){
		      $("#DistrictDistrict").html(data);		      
		    }
		  }
		});
	}
	
</script>

<div class="streets form">
<?php echo $this->Form->create('Street');?>
	<fieldset>
		<legend><?php __('Admin Add Street'); ?></legend>
	<?php
		echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));
		//echo $this->Form->input('name');
		//echo $this->Form->input('order');
		echo $this->Form->input('District');
	?>
        
        <div class="input text"><label for="StreetData">Data</label>
                <textarea name="data[Street][data]" rows="10" cols="50" id="StreetData" class="required"></textarea>
            </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Streets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>