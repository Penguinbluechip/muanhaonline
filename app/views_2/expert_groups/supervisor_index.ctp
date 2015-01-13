<div class="expertGroups index">
	<h2><?php __('Danh sách nhóm CTV');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Mã</th>
			<th>Tên nhóm</th>
			<th>Trưởng nhóm</th>
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($expertGroups as $expertGroup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $expertGroup['ExpertGroup']['id']; ?>&nbsp;</td>
		<td><?php echo $expertGroup['ExpertGroup']['name']; ?>&nbsp;</td>
		<td><?php echo $expertGroup['Expert']['username']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Xem', true), array('action' => 'view', $expertGroup['ExpertGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $expertGroup['ExpertGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Chọn trưởng nhóm', true), array('action' => 'addleader', $expertGroup['ExpertGroup']['id'])); ?>			
			<?php echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $expertGroup['ExpertGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $expertGroup['ExpertGroup']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page% / %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('trước', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Thêm nhóm', true), array('action' => 'add')); ?></li>
		
	</ul>
	
	<?php echo $this->element('supervisorfixpricesidebar'); ?>
</div>