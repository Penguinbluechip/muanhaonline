<script type="text/javascript">
	function changeService(value)
	{
		//alert(value);
		$('#service_description div').css('display', 'none');
		
		$('#service_description_'+value).css('display', 'block');		
	}
</script>

<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Thẩm định BĐS - Bước 1: Thông tin khách hàng');
				
				
				
				
				foreach($breads as $key => $item) {
			?>
				<?php if($key == count($breads)-1) { ?>
					<label><?php echo $item['title'] ?></label>
				<?php } else { ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a> <span>&nbsp;</span>
				<?php } ?>
			<?php } ?>
			 
		</div>	
		
		<div class="page-title">
			<h2>Đăng ký thẩm định giá BĐS</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->element('underconstruction'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">
		
		
		<!--LEFT CONTENT-->			
		<div class="left-content">
                    <div style="margin-left:10px"></div>
		    
			<?php echo $this->element('checkoutline'); ?>
		    
		    
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
			
                        
<div class="fixpriceOrders form fillupform">
		<?php echo $this->Form->create('FixpriceOrder');?>
		<fieldset>
			<legend><h3><?php __('Thông tin khách hàng'); ?></h3></legend>			
				<ul>
					<!--<li>						
							<?php
								echo $this->Form->input('fixprice_customer_id');						
							?>						
					</li>-->
					<li>						
							<?php
								echo $this->Form->input('FixpriceCustomer.name', array('label'=>'Họ và Tên'));								
							?>						
					</li>
					<li>						
							<?php								
								echo $this->Form->input('FixpriceCustomer.email', array('label'=>'Email'));
							?>			
					</li>
					<li>						
							<?php								
								echo $this->Form->input('FixpriceCustomer.phone', array('label'=>'Điện thoại'));
							?>
					</li>
					<li>						
							<?php								
								echo $this->Form->input('FixpriceCustomer.address', array('label'=>'Địa chỉ'));
							?>						
					</li>
				</ul>
			
		</fieldset>
		
		<fieldset id="fixprice_services">
			<legend><h3><?php __('Thông tin dịch vụ thẩm định'); ?></h3></legend>
			<ul>
				<li>
					<?php						
						echo $this->Form->input('fixprice_type_id', array('label'=>'Mục đích thẩm định'));						
					?>
				</li>
				<li>
					<?php						
						echo $this->Form->input('fixprice_service_id', array('label'=>'Lựa chọn dịch vụ', "onchange"=>"changeService(this.value);"));						
					?>
				</li>
				<li>
					<label></label>
					<div id="service_description">
						<?php foreach($fixpriceService_descriptions as $se) { ?>
							<div id="service_description_<?php echo $se['FixpriceService']['id'] ?>">
								<?php echo $se['FixpriceService']['description'] ?>
							</div>
						<?php } ?>
						<br />
						
					</div>					
				</li>
				<li>
					<input type="submit" class="btsubmit" value="Bước kế tiếp" />
				</li>
				
			</ul>
		</fieldset>		
		
		<?php echo $this->Form->end();?>
	
</div>

			
			
			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			<!-- <div class="search advanced">
			</div> -->
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
			
		</div>
		


<script type="text/javascript">	
	$('#service_description div').css('display', 'none');
	$('#service_description_'+$('#FixpriceOrderFixpriceServiceId').val()).css('display', 'block');
	
</script>