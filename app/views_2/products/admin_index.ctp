<div class="products index">
	<h2><?php __('Products');?></h2>
	
	<?php echo $this->render('_filter', '');?>
	
	<table cellpadding="0" cellspacing="0">
	
	
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td onmouseover="$('#hide_row_<?php echo $product['Product']['id'] ?>').css('display','block')" onmouseout="$('#hide_row_<?php echo $product['Product']['id'] ?>').css('display','none')">
			<table width="100%" cellpadding="0" cellspacing="0" style="padding-bottom: 0;margin-bottom: 0">
				<!--<tr>
						<th><?php echo $this->Paginator->sort('id');?></th>
						<th><?php echo __('Image');?></th>
						<th><?php echo $this->Paginator->sort('name');?></th>
						<th><?php echo $this->Paginator->sort('for');?></th>
						<th><?php echo $this->Paginator->sort('category_id');?></th>
						
						<th><?php echo $this->Paginator->sort('project_id');?></th>
						<th><?php echo $this->Paginator->sort('user_id');?></th>
			
					
						<th><?php echo $this->Paginator->sort('price');?></th>
			
						<th><?php echo $this->Paginator->sort('expire_date');?></th>
						<th><?php echo $this->Paginator->sort('create_date');?></th>
				</tr>-->
				<tr>
					<td><?php echo $product['Product']['id']; ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->image("/uploads/product_image/filename/thumb/admin/".$product["ProductImage"]["filename"], array('title' => $product["ProductImage"]["title"])); ?>
					</td>
					<td><a target="_blank" href="<?php echo $this->Html->url(array('action'=>'details', $product['Product']['id'], 'admin'=>false)); ?>"><?php echo $product['Product']['name']; ?></a>&nbsp;</td>
					<td><?php if($product['Product']['for'] == 's') echo 'Bán'; elseif($product['Product']['for'] == 'm') echo 'Mua'; else echo 'Bán';?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
					</td>
					<!--
					<td>
						<?php echo $product['Product']['home_number'].", ".$product['Product']['street'].", ".$product['District']['name'].", " . $product['City']['name']; ?>
					</td>
					-->
					<td>
						<?php echo $this->Html->link($product['Project']['name'], array('controller' => 'projects', 'action' => 'view', $product['Project']['id'])); ?>
					</td>		
					<td>
						<?php echo $this->Html->link($product['User']['username'], array('controller' => 'users', 'action' => 'view', $product['User']['id'])); ?>
					</td>
					
					<td><?php echo $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",")." " : ""; ?><?php echo $product['Product']['price_perm2'] ? $product['CurrencyPrice']['code']."/m2" : $product['CurrencyPrice']['code']; ?>&nbsp;</td>
					
					<td><?php echo $product['Product']['create_date']; ?>&nbsp;</td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0"  id="hide_row_<?php echo $product['Product']['id'] ?>" style="display: none">
				<tr>
					<td width="30%" class="actions" colspan="3" style="text-align: left">
						<?php
								if($product['Product']['published'] == 1)
								{
									$name = __('Duyệt', true);
									echo $this->Html->link($name, array('action' => 'publish', $product['Product']['id']));
									
									$name = __('Loại', true);
									echo $this->Html->link($name, array('action' => 'notvalid', $product['Product']['id']));
								}
						?>			
						
						<?php echo $this->Html->link(__('View/Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
						<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
						<?php echo $product['Product']['published'] != 0 ? $this->Html->link(__('Làm mới tin', true), array('action' => 'renew', $product['Product']['id'])) : ''; ?>
					</td>
					<td style="background: #ccc !important"><strong><?php
					
						if($product['Product']['published'] == 0)
						{
							$name = __('đang soạn', true);
						}
						if($product['Product']['published'] == 1)
						{
							$name = __('chờ duyệt', true);
						}
						else if($product['Product']['published'] == 2)
						{
							$name = __('đang hiển thị', true);
						}
						else if($product['Product']['published'] == 3)
						{
							$name = __('tắt hiển thị', true);
						}
						else if($product['Product']['published'] == -1)
						{
							$name = __('hết hạn', true);
						}
						else if($product['Product']['published'] == -2)
						{
							$name = __('không hợp lệ', true);
						}
						else if($product['Product']['published'] == 10)
						{
							$name = __('BĐS Thẩm định', true);
						}
						echo $name;
					
					?>&nbsp;|&nbsp;</strong>Featured: <?php
					
						if($product['Product']['featured'])
						{
							$name = __('yes', true);
						}
						else
						{
							$name = __('no', true);
						}
						echo $this->Html->link($name, array('action' => 'feature', $product['Product']['id']));
					
					?>&nbsp;|&nbsp;New: <?php
					
						if($product['Product']['top_new'])
						{
							$name = __('yes', true);
						}
						else
						{
							$name = __('no', true);
						}
						echo $this->Html->link($name, array('action' => 'topnew', $product['Product']['id']));
					
					?>&nbsp;|&nbsp;
					
					<?php if($product['Product']['for'] == 's') { ?>
						Sale: <?php
						
							if($product['Product']['top_sale'])
							{
								$name = __('yes', true);
							}
							else
							{
								$name = __('no', true);
							}
							echo $this->Html->link($name, array('action' => 'topsale', $product['Product']['id']));
						
						?>
					<?php } else { ?>
						Lease: <?php
						
							if($product['Product']['top_lease'])
							{
								$name = __('yes', true);
							}
							else
							{
								$name = __('no', true);
							}
							echo $this->Html->link($name, array('action' => 'toplease', $product['Product']['id']));
						
						?>
					<?php } ?>
					&nbsp;|&nbsp;Hit: <?php
					
						if($product['Product']['top_hit'])
						{
							$name = __('yes', true);
						}
						else
						{
							$name = __('no', true);
						}
						echo $this->Html->link($name, array('action' => 'tophit', $product['Product']['id']));
					
					?>&nbsp;|&nbsp;
					Ngày còn lại:
					<strong><?php echo $product['Product']['days'];   ?></strong>&nbsp;|&nbsp;
					Làm mới:
					<strong><?php echo $product['Product']['renew_count'];   ?> lần</strong>
					</td>
					
				</tr>
			</table>
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
	<h3 style="margin-top: 20px"><?php __('Bất động sản'); ?></h3>
	<form action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="bds_published">
		<input type="hidden" name="filter_published" id="filter_published" value="" />
		<ul>
			<li<?php if($published == 'all' || $published == '') echo ' class="active"' ?>><?php echo $this->Html->link(__('Tất cả', true), "#none", array('onclick'=>"$('#filter_published').attr('value','all');$('#bds_published').submit()")); ?></li>
			<li<?php if($published == '1') echo ' class="active"' ?>><?php echo $this->Html->link(__('Đang chờ duyệt ('.$count[1].')', true), "#none", array('onclick'=>"$('#filter_published').attr('value','1');$('#bds_published').submit()")); ?></li>
		</ul>
	</form>
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Types', true), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type', true), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts', true), array('controller' => 'districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District', true), array('controller' => 'districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>-->
		<li><?php echo $this->Html->link(__('List Certificates', true), array('controller' => 'certificates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Certificate', true), array('controller' => 'certificates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div style="display: none">
		  <?php echo $this->element('whoisonline'); ?>
</div>