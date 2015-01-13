<p><?php echo $message?></p>
<br />
<br />
<strong>Gửi từ</strong>: <?php echo $customer["Customer"]["name"] ?><br />
<strong>Email</strong>: <?php echo $customer["Customer"]["email"] ?><br />
<strong>Điện thoại</strong>: <?php echo $customer["Customer"]["phone"] ?><br />
<strong>Bất động sản được quan tâm</strong>:
<a href="http://muanhaonline.com.vn<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($prod["City"]["name"])),
													     'id'=>$prod["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($prod["Product"]["name"])))) ?>" style="float:right;margin-top:5px"><?php echo $prod["Product"]["name"] ?></a>
