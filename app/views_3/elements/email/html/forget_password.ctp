<h2>Thông tin yêu cầu cấp lại tài khoản thành viên từ MuaNhaOnline.com.vn</h2>
<br />
Tên đăng nhập: <strong><?php echo $user["User"]["username"] ?></strong><br />
Mật khẩu tạm thời: <strong><?php echo $rand_password ?></strong><br />
<br />
<strong>Bạn hãy đăng nhập bằng link dưới đây, và thay đổi mật khẩu tạm thời trong tài khoản cá nhân ngay khi có thể</strong>:
<a href="http://muanhaonline.com.vn<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')) ?>">
http://muanhaonline.com.vn<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')) ?>
</a>
