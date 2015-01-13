<div class="projects index">
	<h2><?php __('Các dự án');?></h2>
	
	<?php //echo $this->render('_filter', '');?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Hình ảnh</th>
			<th>Tên</th>
			<th>Loại</th>
			<th>Tỉnh/Thành</th>
			<th>Quận/Huyện</th>
			
			<th>Đường</th>
			<th>Top new</th>
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projects as $project):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->image("/uploads/project_image/filename/thumb/admin/".$project["ProjectImage"]["filename"], array('title' => $project["ProjectImage"]["title"])); ?>
		</td>
		<td><a href="<?php echo $this->Html->url($project['Project']['link']) ?>" target="_blank"><?php echo $project['Project']['name']; ?>&nbsp;</a></td>
		<td><?php echo $project['ProjectCategory']['id'] ? $project['ProjectCategory']['name'] : ''; ?>&nbsp;</td>
		<td><?php echo $project['City']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $project['District']['name']; ?>
		</td>
		
		<td><?php echo $project['Project']['street']; ?>&nbsp;</td>
		
		<td class="actions">			
			<?php echo $this->Html->link(__('Sửa', true), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $project['Project']['id']), null, sprintf(__('Bạn có chắc muốn xóa dự án này, các sản phẩm thuộc dự án cũng bị xóa theo.?', true), $project['Project']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Thêm dự án', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Danh sách BĐS', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Thêm sản phẩm mới', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>