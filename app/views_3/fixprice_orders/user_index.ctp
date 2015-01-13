<div class="fixpriceOrders index">
	<h2><?php __('Yêu cầu thẩm định BĐS');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>STT</th>
			<th>Sản phẩm</th>
			<th>Loại thẩm định</th>
			<th>Loại dịch vụ</th>			
			<th>Ngày tạo</th>
			
			<th class="actions"><?php __('Chức năng');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fixpriceOrders as $stt => $fixpriceOrder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $stt+1; ?>&nbsp;</td>						
		<td>
			<?php $actionx = $fixpriceOrder['FixpriceOrder']['state'] == 'VALID' ? 'order_result' : 'add_step3' ; echo $this->Html->link($fixpriceOrder['Product']['name'], array('controller'=>'fixprice_orders', 'action'=>$actionx, $fixpriceOrder["FixpriceOrder"]["id"], $fixpriceOrder["User"]["email"], 'user'=>false), array('target'=>'_blank')); ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['FixpriceType']['name']; ?>
		</td>
		<td>
			<?php echo $fixpriceOrder['FixpriceService']['name']; ?>
		</td>
		
		<td><?php echo $fixpriceOrder['FixpriceOrder']['create_date']; ?>&nbsp;</td>
		
		<td class="actions">			
			<?php if($fixpriceOrder['FixpriceOrder']['state'] == 'NEW_PRODUCT') { ?>
				<a class="fancybox_link" href="#checkout_box" target="_blank">Thanh toán</a>
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
<div class="actions">
	<?php echo $this->element('userfixpricesidebar'); ?>
	<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
	</div>
</div>

<div id="checkout_box" style="display: none">
	<div>
	<?php if($fixpriceOrder['FixpriceOrder']['state'] == 'NEW_PRODUCT') { ?>
			<h2 class="fix_heading" style="">Chọn hình thức thanh toán</h2>
				<div class="thongtincanho">
				    Chi phí để nhận thông tin thẩm định BĐS này là: <strong style="font-size: 20px"><?php echo $fixpriceOrder["FixpriceService"]["price"] ?> VNĐ</strong> (<?php echo $fixpriceOrder["FixpriceService"]["name"] ?>)
				    <br />
				    Quý khách hãy chọn một trong những hình thức bên dưới để thanh toán vơi chúng tôi:
				    <br />
				    <div class="nganluong_icon_link">
					<h2>Thanh toán bằng cổng NganLuong.vn</h2>
					<a href="<?php echo $fixpriceOrder['FixpriceOrder']['checkout_link']; ?>" target="_blank">
					    <img src="<?php echo $this->Html->url("/img/home/nganluong.png"); ?>" border="0" />
					</a>
					<br />
					(Visa, MasterCard, ATM, ...)
				    </div>
				     <?php if($fixpriceOrder['FixpriceService']['id'] == 1) { ?>
					<div class="sms_icon_link">
					<h2>Thanh toán bằng SMS</h2>
					<p>Để thanh toán dịch vụ thẩm định bằng cách nhắn tin, Quý khách nhắn tin với cú pháp sau đây:</p>
					<p>Nhắn <strong>MNO 000<?php echo $fixpriceOrder['FixpriceOrder']['id'] ?></strong> gửi về <strong>8683</strong></p>										
				    </div>
				     <?php } ?>
				    
				</div>
        <?php } ?>
	</div>
</div>