<div class="userProfiles form">
<?php echo $this->Form->create('UserProfile', array('type' => 'file'));?>
	<fieldset>
		<legend><h3>Sửa thông tin cá nhân</h3></legend>

				<label>Ảnh đại diện</label>
				<a href="<?php echo $this->Html->url("/uploads/user_image/filename/".$this->data["UserImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $this->data["UserImage"]["title"] ?>"><?php echo $this->Html->image("/uploads/user_image/filename/thumb/default/".$this->data["UserImage"]["filename"], array('title' => $this->data["UserImage"]["title"],'class'=>'user_avatar')); ?></a>

                        <?php
                                echo $this->Form->input('name', array('label'=>'Họ và Tên'));
                        ?>

                        <?php

				echo $this->Form->input('company_id', array('empty' => true, 'label'=>'Công ty'));

                        ?>


                        <?php
				echo $this->Form->input('birthday', array(
							'dateFormat' => 'DMY',
							'timeFormat ' => null,
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 18 ));

                                

                        ?>

                        <?php


                                echo $this->Form->input('personal_id', array('type'=>'text', 'label'=>'Số CMND'));

                        ?>

                        <?php


                                echo $this->Form->input('mobile', array('label'=>'ĐTDD'));

                        ?>

                        <?php


                                echo $this->Form->input('phone', array('label'=>'Điện thoại'));

                        ?>

                        <?php


                                echo $this->Form->input('address', array('label'=>'Địa chỉ'));

                        ?>

                        <?php


                                echo $this->Form->input('description', array('label'=>'Mô tả'));

                        ?>

			
					<div class="input file">
					<label for="UserImageFilename"><?php __('Ảnh cá nhân'); ?></label>
					<input type="file" id="UserImageFilename" name="data[UserImage][filename]">
					</div>
					<input type="hidden" id="UserImageDir" name="data[UserImage][dir]" />
					<input type="hidden" id="UserImageMimetype" name="data[UserImage][mimetype]" />
					<input type="hidden" id="UserImageFilesize" name="data[UserImage][filesize]" />

                        <input type="submit" class="btsubmit" value="Lưu thông tin" />
                        

                </ul>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<?php echo $this->element('adminsidebar'); ?>
</div>
		