<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Mã</th>
			<!--<th><?php echo $this->Paginator->sort('fixprice_customer_id');?></th>-->
			<th>Người yêu cầu</th>
			<th>Nhóm CTV</th>
			<th>CTV đảm trách</th>
			<th>Yêu cầu</th>
			<!--<th>Loại dịch vụ</th>-->
			<!--<th><?php echo $this->Paginator->sort('fixprice_service_id');?></th>-->
			
			<th>Ngày tạo</th>
			<th>Hạn còn lại</th>
			<!--<th style="display: none"><?php echo $this->Paginator->sort('status');?></th>-->
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceOrders as $fixpriceOrder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fixpriceOrder['FixpriceOrder']['id']; ?>&nbsp;</td>
		<!--<td>
			<?php echo $this->Html->link($fixpriceOrder['FixpriceCustomer']['name'], array('controller' => 'fixprice_customers', 'action' => 'view', $fixpriceOrder['FixpriceCustomer']['id']), array('title'=>$fixpriceOrder['Product']['name_title'])); ?>
		</td>-->
		<td>
			<?php echo $fixpriceOrder['User']['username']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['ExpertGroup']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['Expert']['username']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['Product']['name']; ?>
		</td>
		<!--<td style="display: none">
			<?php echo $this->Html->link($fixpriceOrder['FixpriceType']['name'], array('controller' => 'fixprice_types', 'action' => 'view', $fixpriceOrder['FixpriceType']['id'])); ?>
		</td>-->
		<!--<td>
			<?php echo $fixpriceOrder['FixpriceService']['name']; ?>
		</td>-->
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		<td><?php if(isset($fixpriceOrder['remain_hours'])) echo $fixpriceOrder['remain_hours']; ?>&nbsp;</td>
		<td style="display: none"><?php echo $fixpriceOrder['FixpriceOrder']['status']; ?>&nbsp;</td>
		<td class="actions">
			
			
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
	<?php echo $this->element('supervisorfixpricesidebar'); ?>
	
</div>