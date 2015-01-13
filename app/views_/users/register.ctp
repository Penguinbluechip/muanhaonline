

	
		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'users', 'action'=>'register')), 'title'=>'Đăng ký thành viên');
				
				
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
			<h2>Đăng ký chuyên viên</h2>
			
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
    <fieldset>
		<legend><h3><?php echo $rule["Content"]["name"] ?></h3></legend>
                <div style="margin:5px; padding:10px; overflow: auto; width: 545px; height: 200px; border: solid 1px #cccccc;background-color:#ffffff; margin-left: 0">
                    <?php echo $rule["Content"]["content"] ?>
                </div>
                <div style="margin-bottom:20px">
                    <input DISABLED type="checkbox" checked="checked" enable="false" style="width:25px;margin:3px;"  />Tôi đồng ý với các điều khoản trên.
                </div>
    </fieldset>
<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
		<legend><h3>Tạo tài khoản chuyên viên</h3></legend>
               
                <ul>

                    <li>
                        <?php                                
                                echo $this->Form->input('User.username', array('label'=>'Tên sử dụng'));
                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('User.email', array('label'=>'Địa chỉ email'));

                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('User.password', array('label'=>'Mật khẩu'));

                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('User.confirm_password', array('type'=>'password', 'label'=>'Xác nhận MK'));

                        ?>
                    </li>
		    
		    <li>
                        <?php
                                echo $this->Form->input('UserProfile.name', array('label'=>'Họ và Tên'));
                        ?>
                    </li>	    
		    
                    <li>
                        <?php
				echo str_replace(array(':', '-'), '', $this->Form->input('UserProfile.birthday', array('label'=>'Ngày sinh','monthNames' => false,
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 18 )));

                                

                        ?>
                    </li>
		    
		    <li>
                        <?php
                                echo $this->Form->input('UserProfile.company', array('label'=>'Doanh nghiệp'));
                        ?>
                    </li>
		    
                    <li>
                        <?php


                                echo $this->Form->input('UserProfile.personal_id', array('type'=>'text', 'label'=>'Số CMND'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('UserProfile.mobile', array('label'=>'ĐTDD'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('UserProfile.phone', array('label'=>'Điện thoại'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('UserProfile.address', array('label'=>'Địa chỉ'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('UserProfile.description', array('label'=>'Mô tả'));

                        ?>
                    </li>
		    <li>
					<div class="input file">
					<label for="UserImageFilename"><?php __('Ảnh cá nhân'); ?></label>
					<input type="file" id="UserImageFilename" name="data[UserImage][filename]">
					</div>
					<input type="hidden" id="UserImageDir" name="data[UserImage][dir]" />
					<input type="hidden" id="UserImageMimetype" name="data[UserImage][mimetype]" />
					<input type="hidden" id="UserImageFilesize" name="data[UserImage][filesize]" />
		    </li>
		    
		    
		    
		    
		    
		    
		    
                    <!--<li>
                        <label>Mã bảo mật</label>
                        <?php App::import('Vendor', 'recaptcha', array('file' => 'recaptchalib.php'));
    
                                //require_once('recaptchalib.php');
                                $publickey = "6LckqMkSAAAAABOO3mI02a_7d2XWpYR6EVMibaGl"; // you got this from the signup page
                                echo recaptcha_get_html($publickey);
    
                        
                        ?>
                    </li>-->
                    <li>
			<label>Mã bảo mật</label>
			<?php
				echo $html->image("captcha/".$captcha_src);
				echo $form->input('User.ver_code', array('label'=>''));			
			?>
                    <li>
			<div style="display: none"><?php echo $this->Form->input('create_date'); ?></div>
                        <input type="submit" class="btsubmit" value="Tạo tài khoản" />
                        <?php echo $this->Form->end();?>
			                    
		    </li>
                </ul>
		
	</fieldset>

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
	

