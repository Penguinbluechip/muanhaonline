<script type="text/javascript">
	function ajaxSetnewpost()
    {	
        $.ajax({
        url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "setnewpost", "manager" => false));?>/',        
        success: function( data ) {
            if (console && console.log){
              
            }
          }
        });
    }
	
</script>

<div class="newsletter" style="padding: 20px 80px 0 80px">   
	<form method="post" action="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'add', 'manager'=>true)) ?>" onsubmit="">
		
		<?php if(!empty($user)) { ?>
            
			<input type="submit" value="Đăng Tin Bất động sản" class="btnsend" /></p>            
			
			<a href="<?php echo $this->Html->url(array('controller'=>'needs', 'action'=>'guest_add')) ?>" class="btnsend">Đăng ký mua/thuê BĐS</a>
			
			<a href="<?php echo $this->Html->url(array('controller'=>'fixprice_orders', 'action'=>'add_step1')) ?>" class="btnsend" style="margin-top: 0">Đăng ký thẩm định BĐS</a></p>
		
		<?php } else { ?>
		
			<input type="button" onclick="showLogBox('product')" value="Đăng Tin Bất động sản" class="btnsend" /></p>            
			
			<a onclick="showLogBox('need')" href="#login" class="btnsend">Đăng ký mua/thuê BĐS</a>
			
			<a onclick="showLogBox('fixprice')" href="#login" class="btnsend" style="margin-top: 0">Đăng ký thẩm định BĐS</a></p>
		
		<?php } ?>
	    
	</form>
</div>