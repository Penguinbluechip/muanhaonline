<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Đăng ký mua/thuê');
				
				
				
				
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
			<h2>Đăng ký thẩm định giá</h2>
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
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
			
                        
<div class="fixpriceOrders form fillupform">
		<?php echo $this->Form->create('FixpriceOrders');?>
		<fieldset>
			<legend><h3><?php __('Thông tin khách hàng'); ?></h3></legend>			
				<ul>
					<!--<li>						
							<?php
								echo $this->Form->input('user_profile_id');						
							?>						
					</li>-->
					<li>						
							<?php
								echo $this->Form->input('UserProfile.name', array('label'=>'Họ và Tên'));								
							?>						
					</li>
					<li>						
							<div class="input text required">
								<label for="UserProfileEmail">Email</label>
								<input type="text" id="UserProfileEmail" maxlength="255" name="data[UserProfile][email]">
							</div>				
					</li>
					<li>						
							<div class="input text required">
								<label for="UserProfilePhone">Số điện thoại</label>
								<input type="text" id="UserProfilePhone" maxlength="255" name="data[UserProfile][phone]">
							</div>
					</li>
					<li>						
							<?php								
								echo $this->Form->input('UserProfile.address', array('label'=>'Địa chỉ'));
							?>						
					</li>
				</ul>
			
		</fieldset>
		
		<fieldset>
			<legend><h3><?php __('Thông tin dịch vụ thẩm định'); ?></h3></legend>
			<ul>				
				<li>
					<?php						
						echo $this->Form->input('user_id');
						
					?>
				</li>
				<li>
					<?php						
						echo $this->Form->input('product_id');						
					?>
				</li>
				<li>
					<?php						
						echo $this->Form->input('fixprice_type_id');						
					?>
				</li>
				<li>
					<?php						
						echo $this->Form->input('fixprice_service_id');						
					?>
				</li>
				<li>
					<?php						
						echo $this->Form->input('fixprice_payment_id');
					?>
				</li>
				<li>
					<?php
						echo $this->Form->input('create_date');
					?>
				</li>
				<li>
					<?php
						echo $this->Form->input('status');
					?>
				</li>				
			</ul>
		</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
	
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
		


