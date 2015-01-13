
       
<div class="customers form fillupform">
<?php echo $this->Form->create('User', array('type' => 'file', 'url'=>$this->Html->url(array('controller'=>'users', 'action'=>'register'))));?>
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
		    
                    <li style="display: none">
                        <?php


                                echo $this->Form->input('UserProfile.personal_id', array('type'=>'text', 'label'=>'Số CMND', 'value'=>'000'));

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
		    <li style="display: none">
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
				echo $form->input('User.ver_code', array('label'=>'', 'placeholder'=>'Nhập mã'));			
			?>
                    <li>
			<div style="display: none"><?php echo $this->Form->input('create_date'); ?></div>
                        <input type="submit" class="btsubmit" value="Tạo tài khoản" />
                        <?php echo $this->Form->end();?>
			                    
		    </li>
                </ul>
		
	</fieldset>

</div>

       