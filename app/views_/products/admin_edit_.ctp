<script type="text/javascript">
    function ajaxFilterDistrict(city_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "districts", "action" => "ajaxDistrictOption", "admin" => false));?>/'+city_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductDistrictId").html(data);
	      //alert($("#ProductDistrictId").val());
	      ajaxFilterProject($("#ProductDistrictId").val());
            }
          }
        });
    }
    
    function ajaxFilterProject(district_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectOption", "admin" => false));?>/'+district_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductProjectId").html(data);
            }
          }
        });
    }
    
    function ajaxFilterCategory(type_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "categories", "action" => "ajaxCategoryOption", "admin" => false));?>/'+type_id,        
        success: function( data ) {
            if (console && console.log){
              $("#ProductCategoryId").html(data);
            }
          }
        });
    }
    
    function ajaxProjectAddress(project_id)
    {
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "projects", "action" => "ajaxProjectAddress", "admin" => false));?>/'+project_id,        
        success: function( data ) {
            if (console && console.log){
              //$("#ProductCategoryId").html(data);
	      var project = eval('(' + data + ')');
	      //alert(data);
	      if(data != 'false')
	      {
		$("#ProductStreet").val(project.Project.street);
		//$('#ProductStreet').attr('disabled', true);
		$("#ProductHomeNumber").val(project.Project.home_number);
		//$('#ProductHomeNumber').attr('disabled', true);
	      }
	      else
	      {
		$("#ProductStreet").val('');
		//$('#ProductStreet').attr('disabled', false);
		$("#ProductHomeNumber").val('');
		//$('#ProductHomeNumber').attr('disabled', false);
	      }
            }
          }
        });
    }
    
</script>

<div class="products form">
<?php echo $this->Form->create('Product');?>
	<fieldset>
		<legend><?php __('Admin Edit Product'); ?></legend>
	<?php	
		echo $this->Form->input('type_id', array("onchange"=>"ajaxFilterCategory(this.value);"));
		echo $this->Form->input('category_id');
		echo $this->Form->input('city_id', array("onchange"=>"ajaxFilterDistrict(this.value);"));
		echo $this->Form->input('district_id', array("onchange"=>"ajaxFilterProject(this.value);"));
		echo $this->Form->input('project_id', array("onchange"=>"ajaxProjectAddress(this.value);"));
		echo $this->Form->input('certificate_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('street');
		echo $this->Form->input('block');
		echo $this->Form->input('home_number');
		
		?>
		<div class="input text required">
			<label for="ProductBedrooms"><?php echo __('Bedrooms'); ?></label>
			
			<select id="ProductBedrooms" name="data[Product][bedrooms]">
				<?php
				for($i=1; $i < 11; $i++)
				{
					$selected = '';
					if($this->data["Product"]["bedrooms"] == $i)
					{
						$selected = ' selected="selected "';
					}
					?>
					<option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php
		
		?>
		<div class="input text required">
			<label for="ProductBathrooms"><?php echo __('Bathrooms'); ?></label>
			
			<select id="Bathrooms" name="data[Product][bathrooms]">
				<?php
				for($i=1; $i < 11; $i++)
				{
					$selected = '';
					if($this->data["Product"]["bathrooms"] == $i)
					{
						$selected = ' selected="selected "';
					}
					?>
					<option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php	
		
		echo $this->Form->input('property_area');
		echo $this->Form->input('lot_area');
		
		?>
		<div class="input text required">
			<label for="ProductFloor"><?php echo __('Floors'); ?></label>
			
			<select id="ProductFloors" name="data[Product][floors]">
				<?php
				$floors = array(array("1", "1"),array("1.5", "one and half"),array("2", "2"),array("3", "3"),array("4", "4"),array("5", "5"),array("gt5", 'more than 5'));
				foreach($floors as $f)
				{
					$selected = '';
					if($this->data["Product"]["floors"] == $f[0])
					{
						$selected = ' selected="selected"';
					}
					?>
					<option value="<?php echo $f[0]; ?>"<?php echo $selected ?>><?php echo $f[1]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php
		
		echo $this->Form->input('price');
		
		?>
		<div class="input text required">
			<label for="ProductPriceCurrency"><?php echo __('Price Currency'); ?></label>
			
			<select id="ProductPriceCurrency" name="data[Product][price_currency]">
				<?php
				foreach($currencies as $c)
				{
					$selected = '';
					if($this->data["Product"]["price_currency"] == $c["CurrencyPrice"]["id"])
					{
						$selected = ' selected="selected "';
					}
					?>
					<option value="<?php echo $c["CurrencyPrice"]["id"]; ?>"<?php echo $selected ?>><?php echo $c["CurrencyPrice"]["code"]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php		
		
		echo $this->Form->input('price_perm2', array("type"=>"checkbox"));
		echo $this->Form->input('commission');
		
		?>
		<div class="input text required">
			<label for="ProductCommissionCurrency"><?php __('Commission Currency'); ?></label>
			
			<select id="ProductCommissionCurrency" name="data[Product][commission_currency]">
				<?php
				foreach($currencies as $c)
				{
					$selected = '';
					if($this->data["Product"]["commission_currency"] == $c["CurrencyPrice"]["id"])
					{
						$selected = ' selected="selected "';
					}
					?>
					<option value="<?php echo $c["CurrencyPrice"]["id"]; ?>"<?php echo $selected ?>><?php echo $c["CurrencyPrice"]["code"]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php			
		
		echo $this->Form->input('expire_date');
		echo $this->Form->input('create_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Product.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Types', true), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type', true), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Certificates', true), array('controller' => 'certificates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Certificate', true), array('controller' => 'certificates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency Price', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script type="text/javascript">
ajaxProjectAddress('<?php echo $this->data["Product"]["project_id"] ?>');
</script>