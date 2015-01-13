<script type="text/javascript">
    function checkSubmitUser()
    {
        //alert("sdfsdfsf");
        if($('#UserUsername').val() != "Tên đăng nhập" && $('#UserUsername').val() != "")
        {
            //alert("ok");
            return true;
        }
        else
        {
            alert("Bạn phải nhập tên đăng nhập");
            return false;
        }
        
    }
</script>

<?php $user = $this->requestAction('users/getUser'); //var_dump($user); ?>

<?php if(!$user) { ?>
<form style="float:right" method="post" onsubmit="return checkSubmitUser();" action="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')); ?>" id="login-form">
						<label><input type="text" value="Tên đăng nhập" onblur="if(this.value==''){this.value='Tên đăng nhập';}" onfocus="if(this.value=='Tên đăng nhập'){this.value='';}"  id="UserUsername" name="data[User][username]"></label>
						<label><input  id="UserPassword" name="data[User][password]" type="password" value="Mật khẩu" onblur="if(this.value==''){this.value='Mật khẩu';}" onfocus="if(this.value=='Mật khẩu'){this.value='';}"></label>
						<label><a href="#"><span onclick="if(checkSubmitUser()) $('#login-form').submit()" style="background-color: #d68c46; padding:3px 5px; color: #fff">Đăng nhập</span></a> </label>
						<input type="submit" style="display:none" />
						<label><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>"><span onclick="" style="background-color: #d68c46; padding:3px 5px; color: #fff">Đăng ký</span></a> </label>
</form>

<?php } else { ?>
<div style="text-align:right;float:right">

						

<?php echo $this->Html->link('Đăng xuất', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'users', 'action'=>'logout')); ?>
 -
<?php if($user['Group']['id'] != 4) echo $this->Html->link('Trang cá nhân', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'products', 'action'=>'index', 'manager'=>true));
	else echo $this->Html->link('Trang Cộng tác viên', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'fixprice_orders', 'action'=>'index', 'expert'=>true));
?>                                       
</div>
<?php } ?>