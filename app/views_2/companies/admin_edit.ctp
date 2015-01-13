<div class="companies form">
<?php echo $this->Form->create('Company', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Admin Edit Company'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('company_category_id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('website');
		echo $this->Form->input('description');
		echo $this->Form->input('address');
	?>
	<a href="<?php echo $this->Html->url("/uploads/user_image/filename/".$this->data["CompanyImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $this->data["CompanyImage"]["title"] ?>"><?php echo $this->Html->image("/uploads/company_image/filename/thumb/admin/".$this->data["CompanyImage"]["filename"], array('title' => $this->data["CompanyImage"]["title"],'height'=>'100px')); ?></a>
	
					<div class="input file">
					<label for="CompanyImageFilename"><?php __('Company Image'); ?></label>
					<input type="file" id="CompanyImageFilename" name="data[CompanyImage][filename]">
					</div>
					<input type="hidden" id="CompanyImageDir" name="data[CompanyImage][dir]" />
					<input type="hidden" id="CompanyImageMimetype" name="data[CompanyImage][mimetype]" />
					<input type="hidden" id="CompanyImageFilesize" name="data[CompanyImage][filesize]" />
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Company.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Company.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Company Categories', true), array('controller' => 'company_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company Category', true), array('controller' => 'company_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>