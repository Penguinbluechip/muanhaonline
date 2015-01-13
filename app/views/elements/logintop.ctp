



<?php $user = $this->requestAction('users/getUser'); //var_dump($user); ?>

<?php if(!$user) { ?>
<form style="float:right" method="post" onsubmit="return checkSubmitUser();" action="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')); ?>" id="login-form">
						
						<label><a href="#"><span onclick="showLogBox('toplogin')" style="background-color: #d68c46; padding:3px 5px; color: #fff">Đăng nhập</span></a> </label>
						<input type="submit" style="display:none" />
						<label><a href="#res"><span onclick="showRegisterBox()" style="background-color: #d68c46; padding:3px 5px; color: #fff">Đăng ký</span></a> </label>
</form>

<?php } else { ?>
<div style="text-align:right;float:right">

						

Chào <strong><?php echo $user['username'] ?></strong>, 

<?php
    if($user['Group']['id'] == 2)
    {
	    echo $this->Html->link('trang cá nhân', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'products', 'action'=>'index', 'manager'=>true));
    } 
    else if($user['Group']['id'] == 3)
    {
	    echo $this->Html->link('trang cá nhân', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'fixprice_orders', 'action'=>'index', 'user'=>true));
    }
    else if($user['Group']['id'] == 6)
    {
	    $count = $this->requestAction('users/getNotifications');
	    $count = $count ? " (".$count." tin mới)" : "";
	    echo $this->Html->link('trang thẩm định viên'.$count, array('plugin'=>null, 
					'admin'=>false, 'controller'=>'fixprice_orders', 'action'=>'index', 'inspector'=>true));
    }
    else
    {
	    $count = $this->requestAction('users/getNotifications');
	    $count = $count ? " (".$count." tin mới)" : "";
	    echo $this->Html->link('trang cộng tác viên'.$count, array('plugin'=>null, 
					'admin'=>false, 'controller'=>'fixprice_orders', 'action'=>'index', 'expert'=>true));
    }

 
					
    echo " - ".$this->Html->link('Đăng xuất', array('plugin'=>null, 
					'admin'=>false, 'controller'=>'users', 'action'=>'logout'));
?>                                       
</div>
<?php } ?>