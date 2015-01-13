<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Thay đổi mật khẩu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('old_password', array('type'=>'password', 'label'=>'Mật khẩu đang dùng'));
		echo $this->Form->input('new_password', array('type'=>'password', 'label'=>'Mật khẩu mới'));
		echo $this->Form->input('new_password_confirm', array('type'=>'password', 'label'=>'Nhập lại mật khẩu mới'));
	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Đổi mật khẩu', true));?>
</div>
<div class="actions">
	<?php echo $this->element('adminsidebar'); ?>
</div>