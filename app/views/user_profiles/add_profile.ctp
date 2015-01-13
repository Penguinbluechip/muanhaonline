

	
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

<?php echo $this->Form->create('UserProfile', array('type' => 'file'));?>
	<fieldset>
		<legend><h3>Tạo tài khoản chuyên viên</h3></legend>
               
                <ul>

                    <li>
                        <?php
                                echo $this->Form->input('name', array('label'=>'Họ và Tên'));
                        ?>
                    </li>
		    <li>
                        <?php

				echo $this->Form->input('company_id', array('empty' => true, 'label'=>'Công ty'));

                        ?>
                    </li>
                    <li>
                        <?php
				echo $this->Form->input('birthday', array(
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 18 ));

                                

                        ?>
                    </li>
                    <li>
                        <?php


                                echo $this->Form->input('personal_id', array('type'=>'text', 'label'=>'Số CMND'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('mobile', array('label'=>'ĐTDD'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('phone', array('label'=>'Điện thoại'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('address', array('label'=>'Địa chỉ'));

                        ?>
                    </li>
		    <li>
                        <?php


                                echo $this->Form->input('description', array('label'=>'Mô tả'));

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
                    
                    <li>
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
			<div class="search1">
				
				
			</div>
			
		</div>

	<!--FOOTER CONTAINER-->
	