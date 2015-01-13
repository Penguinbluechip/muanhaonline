<div class="fixpriceAnswers view">
<h2><?php  __('Fixprice Answer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceAnswer['FixpriceAnswer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fixprice Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fixpriceAnswer['FixpriceOrder']['user_profile_id'], array('controller' => 'fixprice_orders', 'action' => 'view', $fixpriceAnswer['FixpriceOrder']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceAnswer['FixpriceAnswer']['price_total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceAnswer['FixpriceAnswer']['price_unit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fixpriceAnswer['FixpriceAnswer']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fixprice Answer', true), array('action' => 'edit', $fixpriceAnswer['FixpriceAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fixprice Answer', true), array('action' => 'delete', $fixpriceAnswer['FixpriceAnswer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fixpriceAnswer['FixpriceAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Answers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Answer', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fixprice Orders', true), array('controller' => 'fixprice_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixprice Order', true), array('controller' => 'fixprice_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
