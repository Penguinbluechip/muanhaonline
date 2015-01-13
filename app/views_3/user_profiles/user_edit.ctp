<div class="userProfiles form">
<?php echo $this->Form->create('UserProfile', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Admin Edit User Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('company_id', array('empty' => true, 'label'=>'Công ty'));
		echo $this->Form->input('birthday', array(
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 18 ));
		echo $this->Form->input('email');
		echo $this->Form->input('personal_id', array('type'=>'text'));
		echo $this->Form->input('mobile');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this->Form->input('description');
	?>
	
	
			<a href="<?php echo $this->Html->url("/uploads/user_image/filename/".$this->data["UserImage"]["filename"]) ?>" rel="prettyPhoto[p-image]" title="<?php echo $this->data["UserImage"]["title"] ?>"><?php echo $this->Html->image("/uploads/user_image/filename/thumb/admin/".$this->data["UserImage"]["filename"], array('title' => $this->data["UserImage"]["title"],'height'=>'50px')); ?></a>
					<div class="input file">
					<label for="UserImageFilename"><?php __('Change Profile Image'); ?></label>
					<input type="file" id="UserImageFilename" name="data[UserImage][filename]">
					</div>
					<input type="hidden" id="UserImageDir" name="data[UserImage][dir]" />
					<input type="hidden" id="UserImageMimetype" name="data[UserImage][mimetype]" />
					<input type="hidden" id="UserImageFilesize" name="data[UserImage][filesize]" />
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('UserProfile.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('UserProfile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Profiles', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>