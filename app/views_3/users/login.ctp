<!--BREADCRUMB-->
		<div class="breadcrumb">
			<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a><span>&nbsp;</span><label>Thành viên</label>
		</div>	
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Đăng nhập</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
                <div class="flash">
			<?php echo $this->Session->flash(); ?>
                        <?php echo $this->Session->flash('auth'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			
			<!--FILLUP FORM-->
			<div class="fillupform">
				
				<?php if(empty($user)) { ?>
				
					<h2>Đăng nhập</h2>
					<?php
					    echo $this->Form->create(array('action'=>'login'));
					    ?>
	
						<ul class="clear contact login_form"> 
							<li>
								<?php echo $this->Form->input('username', array('label'=>'Tên đăng nhập')); ?>
							</li>
	
							<li>
								<?php echo $this->Form->input('password', array('label'=>'Mật khẩu')); ?>
							</li>
	
							<li>
								<label>&nbsp;</label>        
								<input class="btsubmit" type="submit" name="data[btsend]" value="Gửi" id="btncontact" />
								<br /><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'forget_password')) ?>" >Quên tên đăng nhập/mật khẩu?</a><br />
								<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register')) ?>" >Đăng ký thành viên</a>
								
							</li>
							<li>
								<label>&nbsp;</label>      						
								
							</li>
						 </ul>
					<?php
					    echo $this->Form->end();
					?>
				
				<?php } else { ?>
					
					Chào <strong><?php echo $user['username'] ?></strong>, 
					
					<?php echo $this->Html->link('Đăng xuất', array('plugin'=>null, 
									'admin'=>false, 'controller'=>'users', 'action'=>'logout')); ?>
				<?php } ?>
				
			</div>
		</div>
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			
			<!--NEWSLETTER-->
			<?php //echo $this->element('registerbox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			
			<?php echo $this->element('whoisonline'); ?>
		</div>



