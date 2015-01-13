<div class="companyCategories view">
<h2><?php  __('Company Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $companyCategory['CompanyCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $companyCategory['CompanyCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $companyCategory['CompanyCategory']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $companyCategory['CompanyCategory']['order']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company Category', true), array('action' => 'edit', $companyCategory['CompanyCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Company Category', true), array('action' => 'delete', $companyCategory['CompanyCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $companyCategory['CompanyCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Company Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company Category', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
