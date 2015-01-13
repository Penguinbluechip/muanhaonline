<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Bất động sản');
                                $breads[] = array('link'=>$this->Html->url(array('controller'=>'products', 'action'=>'reset')), 'title'=>'Thẩm định BĐS');
				

				
				foreach($breads as $key => $item) {
			?>
				<?php if($key == count($breads)-1) { ?>
					<label><?php echo $item['title'] ?></label>
				<?php } else { ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a> <span>&nbsp;</span>
				<?php } ?>
			<?php } ?>
			 
		</div>	
		
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Hoàn tất đăng ký thẩm định</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->element('underconstruction'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">
            <div class="left-content">
	    
		<?php echo $this->element('checkoutline'); ?>
		
                <div class="thongtincanho">
                            Cám ơn quý khách hàng đã đăng ký dịch vụ của chúng tôi. Thông tin dịch vụ chúng tôi sẽ thông báo trực tiếp đến email của quý khách.
                            <br />
                            <a href="<?php echo $this->Html->url("/") ?>">Trở về trang chủ</a>
                            
                </div>
            </div>
			
                
                <!--SIDEBARS-->		
	<div class="sidebar">
			
			<!-- <div class="search advanced">
			</div> -->
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
	</div>



<div id="login" class="popup">
	<h2>Đăng nhập</h2>
	<form method="post" action="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'login')); ?>" id="login-form">
		<ul>
			<li><label>Tên đăng nhập</label> <input type="text" name="data[User][username]" class="large" value="" /></li>
			<li><label>Mật mã</label> <input type="password" name="data[User][password]" class="large" value="" /></li>
			
			

			
		</ul>
		<div class="clear">
			<input type="submit" name="Tìm" value="Đăng nhập" />
			<label class="text">Đăng nhập vào hệ thống.</label>
		</div>

	</form>
</div>