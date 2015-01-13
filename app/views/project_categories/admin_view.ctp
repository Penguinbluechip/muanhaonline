<div class="projectCategories view">
<h2><?php  __('Project Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectCategory['ProjectCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectCategory['ProjectCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectCategory['ProjectCategory']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project Category', true), array('action' => 'edit', $projectCategory['ProjectCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Project Category', true), array('action' => 'delete', $projectCategory['ProjectCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectCategory['ProjectCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Projects');?></h3>
	<?php if (!empty($projectCategory['Project'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('City Id'); ?></th>
		<th><?php __('District Id'); ?></th>
		<th><?php __('Project Category Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Street'); ?></th>
		<th><?php __('Home Number'); ?></th>
		<th><?php __('Longitude'); ?></th>
		<th><?php __('Latitude'); ?></th>
		<th><?php __('Lot Area'); ?></th>
		<th><?php __('Property Area'); ?></th>
		<th><?php __('Area X'); ?></th>
		<th><?php __('Area Y'); ?></th>
		<th><?php __('Property Percent'); ?></th>
		<th><?php __('Floors'); ?></th>
		<th><?php __('Block Per Floor'); ?></th>
		<th><?php __('Build Start'); ?></th>
		<th><?php __('Build End'); ?></th>
		<th><?php __('Build Start Real'); ?></th>
		<th><?php __('Build Base Real'); ?></th>
		<th><?php __('Build End Real'); ?></th>
		<th><?php __('Build Book'); ?></th>
		<th><?php __('Cdt'); ?></th>
		<th><?php __('Dvtc'); ?></th>
		<th><?php __('Dvtk'); ?></th>
		<th><?php __('Dvqlda'); ?></th>
		<th><?php __('Create Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($projectCategory['Project'] as $project):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $project['id'];?></td>
			<td><?php echo $project['user_id'];?></td>
			<td><?php echo $project['city_id'];?></td>
			<td><?php echo $project['district_id'];?></td>
			<td><?php echo $project['project_category_id'];?></td>
			<td><?php echo $project['name'];?></td>
			<td><?php echo $project['description'];?></td>
			<td><?php echo $project['street'];?></td>
			<td><?php echo $project['home_number'];?></td>
			<td><?php echo $project['longitude'];?></td>
			<td><?php echo $project['latitude'];?></td>
			<td><?php echo $project['lot_area'];?></td>
			<td><?php echo $project['property_area'];?></td>
			<td><?php echo $project['area_x'];?></td>
			<td><?php echo $project['area_y'];?></td>
			<td><?php echo $project['property_percent'];?></td>
			<td><?php echo $project['floors'];?></td>
			<td><?php echo $project['block_per_floor'];?></td>
			<td><?php echo $project['build_start'];?></td>
			<td><?php echo $project['build_end'];?></td>
			<td><?php echo $project['build_start_real'];?></td>
			<td><?php echo $project['build_base_real'];?></td>
			<td><?php echo $project['build_end_real'];?></td>
			<td><?php echo $project['build_book'];?></td>
			<td><?php echo $project['cdt'];?></td>
			<td><?php echo $project['dvtc'];?></td>
			<td><?php echo $project['dvtk'];?></td>
			<td><?php echo $project['dvqlda'];?></td>
			<td><?php echo $project['create_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'projects', 'action' => 'view', $project['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'projects', 'action' => 'edit', $project['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'projects', 'action' => 'delete', $project['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
