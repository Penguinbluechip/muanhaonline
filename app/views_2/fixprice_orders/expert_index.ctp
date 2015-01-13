<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định BĐS');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!--<th>Mã</th>	-->		
			<th>Tên yêu cầu</th>
			<th>Loại yêu cầu</th>
			<th>Mục đích</th>
			<?php if(in_array($status, array('EXPERT_CONFIRMED_LEAD','EXPERT_REJECTED_LEAD','WORKING_LEAD','FAILED_LEAD','FINISHED_ALL_LEAD'))){ ?>
				<th>Chuyên viên</th>			
			<?php } ?>
			<?php if(in_array($status, array('WORKING'))){ ?>
				<th>Thời hạn</th>			
				<th>Trạng thái</th>
			<?php } ?>
			
			<th>Ghi chú</th>
			
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
		<!--<td><?php echo $fixpriceOrder['FixpriceOrder']['id']; ?>&nbsp;</td>-->					
		<td>
			<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'expert_view', $fixpriceOrder['FixpriceOrder']['id'])) ?>"><?php echo $fixpriceOrder['Product']['name']; ?></a>
		</td>
		<!--<td>
			<?php echo $fixpriceOrder['ExpertGroup']['name']; ?>
		</td>-->
		<!--<td>
			<?php echo $fixpriceOrder['Expert']['username']; ?>
		</td>-->
		<td>
			<?php echo $fixpriceOrder['FixpriceService']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['FixpriceType']['name']; ?>
		</td>
		
		<?php if(in_array($status, array('EXPERT_CONFIRMED_LEAD','EXPERT_REJECTED_LEAD','WORKING_LEAD','FAILED_LEAD','FINISHED_ALL_LEAD'))){ ?>
			<td>
				<?php echo $fixpriceOrder['Expert']['username']; ?>
			</td>		
		<?php } ?>
		
		<!--<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>-->
		
		<?php if(in_array($status, array('WORKING'))){ ?>
			<td align="center" class="remain_hours">
				<img width="25" src="<?php echo $this->Html->url("/img/stat_level_".$fixpriceOrder['remain_stat']); ?>.png" />
				<span><?php echo $fixpriceOrder['remain_hours']; ?></span>
			
			
			&nbsp;</td>
			<td>
				<?php echo $fixpriceOrder['FixpriceOrderState']['name']; ?>		
			&nbsp;</td>
		<?php } ?>
		<td>
			<?php echo $fixpriceOrder['FixpriceOrdersState']['note']; ?>
		</td>
		<td class="actions">
			
			<?php if($fixpriceOrder['FixpriceOrderState']['alias'] == 'PAID'){
				echo $this->Html->link(__('Đăng ký', true), '#assign_confirm_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#assign_confirm_box label strong").html("'.$fixpriceOrder['Product']['name'].'");$("#assign_confirm_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")'));
			} ?>
			<?php if($fixpriceOrder['FixpriceOrderState']['alias'] == 'PAID' && $isLeader){
				echo $this->Html->link(__('Đăng ký cho nhóm', true), array('controller'=>'fixprice_orders','action' => 'resorder', $fixpriceOrder['FixpriceOrder']['id']));
			} ?>
			<?php if($fixpriceOrder['FixpriceOrderState']['alias'] == 'REGISTERED' && $isLeader){
				echo $this->Html->link(__('Bàn giao', true), array('controller'=>'fixprice_orders','action' => 'assign', $fixpriceOrder['FixpriceOrder']['id']));
			} ?>
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrderState']['alias'] == 'EXPERT_CONFIRMED' || $fixpriceOrder['FixpriceOrderState']['alias'] == 'INVALID') { ?>
				<?php echo $this->Html->link(__('Thẩm định', true), array('controller'=>'fixprice_answers','action' => 'add', $fixpriceOrder['FixpriceOrder']['id'])); ?>
				<?php echo $this->Html->link(__('Đăng thẩm định', true), array('controller'=>'fixprice_orders','action' => 'postanswer', $fixpriceOrder['FixpriceOrder']['id'])); ?>
			<?php } ?>
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrderState']['alias'] == 'ASSIGNED') { ?>
				<?php echo $this->Html->link(__('Nhận thẩm định', true), '#confirm_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#confirm_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>
				<?php echo $this->Html->link(__('Từ chối thẩm định', true), '#reject_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#reject_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>
				
				
			<?php } ?>
			<?php if(isset($fixpriceOrder['remain_hours']) && $fixpriceOrder['remain_hours'] > 0) if($fixpriceOrder['FixpriceOrderState']['alias'] == 'EXPERT_REJECTED') { ?>
				<?php echo $this->Html->link(__('Nhận thẩm định', true), '#assignleader_box', array('class'=>'fancybox_link', 'onmouseover'=>'$("#assignleader_box #FixpriceOrderId").attr("value", "' .$fixpriceOrder['FixpriceOrder']['id']. '")')); ?>				
			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page%/%pages%, hiển thị %current% trên %count% yêu cầu', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('trước', true), array(), null, array('class'=>'disabled'));?>
	| 	<?php echo $this->Paginator->numbers();?>
	|
		<?php echo $this->Paginator->next(__('sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions expert_leftbar">
	<?php echo $this->element('expertsidebar'); ?>
	<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
	</div>
</div>

<div id="confirm_box" style="display: none; padding: 10px;">
	<label><strong>Đồng ý tiếp nhận thẩm định yêu cầu này !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'confirm'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>

<div id="assign_confirm_box" style="display: none; padding: 10px;">
	<label>Xác nhận đăng ký thẩm định yêu cầu "<strong></strong>" !! </label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'assign_confirm'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->hidden('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text', 'value'=>'auto'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>

<div id="reject_box" style="display: none; padding: 10px;">
	<label><strong>Từ chối nhận thẩm định yêu cầu !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'reject'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>

<div id="assignleader_box" style="display: none; padding: 10px;">
	<label><strong>Nhận yêu cầu thẩm định !! </strong></label><br /><br />
	<?php echo $this->Form->create('FixpriceOrder', array('action'=>'assignleader'));?>
		
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('FixpriceOrdersState.note', array('label'=>'Ghí chú (tùy chọn)', 'type'=>'text'));		
		?>
	
	<?php echo $this->Form->end(__('Xác nhận', true));?>
</div>