		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'customers', 'action'=>'contact')), 'title'=>'Liên hệ');
				
				
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
			<h2>Liên hệ chuyên viên</h2>
			
		</div>
                <div class="flash">
			<?php echo $this->Session->flash(); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">
		
		
		<!--LEFT CONTENT-->			
		<div class="left-content">
                    <div style="margin-left:10px"></div>			
			
			<!--PROPERTY DETAILS-->
                        
                        
       

       
<div class="customers form fillupform">
<?php echo $this->Form->create('Customer');?>
	<fieldset>
		<legend><h3><?php echo $product["Product"]["name"]; ?></h3></legend>
                <div>
                    <strong>Chuyên viên</strong>: <?php echo $usr["UserProfile"]["name"] ?>
                </div>
                <div>
                    <strong>Email</strong>:  <?php echo $usr["User"]["email"] ?>
                </div>
                <div>
                    <strong>Điện thoại</strong>:  <?php echo $usr["UserProfile"]["phone"] ?>
                </div>
                <ul>

                    <li>
                        <?php
                                echo $this->Form->input('user_id', array('type'=>'hidden'));
                                echo $this->Form->input('product_id', array('type'=>'hidden'));
                                echo $this->Form->input('name', array('label'=>'Họ và Tên'));
                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('phone', array('label'=>'Điện thoại'));

                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('email', array('label'=>'Email'));

                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('message', array('label'=>'Thông điệp'));
                        ?>
                    </li>
		   <!-- <li>
								<label>Mã bảo mật</label>
								<?php App::import('Vendor', 'recaptcha', array('file' => 'recaptchalib.php'));
					    
									//require_once('recaptchalib.php');
									$publickey = "6LckqMkSAAAAABOO3mI02a_7d2XWpYR6EVMibaGl"; // you got this from the signup page
									echo recaptcha_get_html($publickey);
					    
								
								?>
							</li>
                    <li>-->
			<input type="submit" class="btsubmit" value="Hoàn thành" />
                        
                    </li>
                </ul>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

       

                        
                        
			
			
			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('whoisonline'); ?>
			<div class="search1">
				
				
			</div>
			
		</div>

	<!--FOOTER CONTAINER-->
	

