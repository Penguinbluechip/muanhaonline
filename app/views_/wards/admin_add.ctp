<script type="text/javascript">
	function ajaxFilterDistrict(city_id)
	{
		$.ajax({
		url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
		success: function( data ) {
		    if (console && console.log){
		      $("#WardDistrictId").html(data);
		      //alert($("#ProductDistrictId").val());
		      ajaxFilterProject($("#WardDistrictId").val());
		    }
		  }
		});
	}
	
</script>
<div class="wards form">
<?php echo $this->Form->create('Ward');?>
	<fieldset>
		<legend><?php __('Admin Add Ward'); ?></legend>
	<?php
		echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);", 'label'=>'Tỉnh/Thành'));
		echo $this->Form->input('district_id');
		echo $this->Form->input('name');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Wards', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
	</ul>
</div>