<div class="occupantTypes view">
<h2><?php  __('Occupant Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $occupantType['OccupantType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $occupantType['OccupantType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $occupantType['OccupantType']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Occupant Type', true), array('action' => 'edit', $occupantType['OccupantType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Occupant Type', true), array('action' => 'delete', $occupantType['OccupantType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $occupantType['OccupantType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Occupant Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Occupant Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related Products');?></h3>
	<?php if (!empty($occupantType['Product'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['type_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['category_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['city_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('District Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['district_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['project_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Certificate Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['certificate_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['description'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Street');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['street'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Block');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['block'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Home Number');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['home_number'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bedrooms');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['bedrooms'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bathrooms');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['bathrooms'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Property Area');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['property_area'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lot Area');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['lot_area'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Floors');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['floors'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['price'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Currency');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['price_currency'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Perm2');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['price_perm2'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Commission');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['commission'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Commission Currency');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['commission_currency'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['owner_name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner Name Privacy');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['owner_name_privacy'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner Phone');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['owner_phone'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner Phone Privacy');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['owner_phone_privacy'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Occupant Type Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['occupant_type_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Occupant Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['occupant_name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Occupant Name Privacy');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['occupant_name_privacy'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Occupant Phone');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['occupant_phone'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Occupant Phone Privacy');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['occupant_phone_privacy'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Expire Date');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['expire_date'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Create Date');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $occupantType['Product']['create_date'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Product', true), array('controller' => 'products', 'action' => 'edit', $occupantType['Product']['id'])); ?></li>
			</ul>
		</div>
	</div>
	