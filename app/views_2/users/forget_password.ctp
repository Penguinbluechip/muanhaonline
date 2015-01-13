<!--BREADCRUMB-->
		<div class="breadcrumb">
			<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a><span>&nbsp;</span><label>Thành viên</label>
		</div>	
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Quên tên đăng nhập/mật khẩu</h2>
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
				<h2>Thông tin tài khoản</h2>
                                <?php
                                    echo $this->Form->create(array('action'=>'forget_password'));
                                    ?>

					<ul class="clear contact login_form"> 
						<li>
							<?php echo $this->Form->input('re_username', array('label'=>'Tên đăng nhập')); ?>
						</li>

						<li>
							<?php echo $this->Form->input('re_email', array('label'=>'Địa chỉ email')); ?>
						</li>

						<li>
							<label>&nbsp;</label>        
							<input class="btsubmit" type="submit" name="data[btsend]" value="Xác nhận" id="btncontact" />
							<br /><a href="" >Nhập tên đăng nhập hoặc địa chỉ email để được cấp lại thông tin tài khoản</a>
							
						</li>
						
					 </ul>
				<?php
                                    echo $this->Form->end();
                                ?>
			</div>
		</div>
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			
			<!--NEWSLETTER-->
			<?php echo $this->element('registerbox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			
			<?php echo $this->element('whoisonline'); ?>
		</div>



