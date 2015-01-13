<div class="needs index">
	<h2><?php __('Danh sách các nhu cầu');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th>Tên nhu cầu</th>
			<th>Mô tả thêm</th>
			<th>Ngày tạo</th>
			
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($needs as $need):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>	
		
		<td><?php echo $need['Need']['name']; ?>&nbsp;</td>
		<td><?php echo $need['Need']['description']; ?>&nbsp;</td>
		<td><?php echo $need['Need']['create_date']; ?>&nbsp;</td>

		<td class="actions">			
			<?php echo $this->Html->link(__('Xem/Sửa', true), array('action' => 'edit', $need['Need']['id'])); ?>
			<?php echo $this->Html->link(__('Xóa', true), array('action' => 'delete', $need['Need']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $need['Need']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('Trước', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Chức năng'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Thêm nhu cầu', true), array('action' => 'add')); ?></li>
		
	</ul>
</div>