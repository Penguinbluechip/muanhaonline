<div class="contentCategories view">
<h2><?php  __('Content Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentCategory['ContentCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentCategory['ContentCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentCategory['ContentCategory']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Content Category', true), array('action' => 'edit', $contentCategory['ContentCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Content Category', true), array('action' => 'delete', $contentCategory['ContentCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contentCategory['ContentCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Content Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contents', true), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Contents');?></h3>
	<?php if (!empty($contentCategory['Content'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Content Category Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Content'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($contentCategory['Content'] as $content):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $content['id'];?></td>
			<td><?php echo $content['content_category_id'];?></td>
			<td><?php echo $content['name'];?></td>
			<td><?php echo $content['content'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'contents', 'action' => 'view', $content['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'contents', 'action' => 'edit', $content['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'contents', 'action' => 'delete', $content['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $content['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
