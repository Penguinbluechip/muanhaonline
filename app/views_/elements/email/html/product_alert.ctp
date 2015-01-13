<p>Chào <?php echo $cname ?>,</p>
<p>Chúng tôi gửi bạn thông tin BĐS mới phù hợp với nhu cầu của bạn tại website MuaNhaOnline.com.vn</p>

<p>Tên nhu cầu:
<strong><?php echo $need['Need']['name'] ?></strong>

</p>
<p>
<strong>Bất động sản liên quan</strong>:
<a href="http://muanhaonline.com.vn<?php echo $this->Html->url(array('admin'=>false, 'controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($prod["City"]["name"])),
													     'id'=>$prod["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($prod["Product"]["name"])))) ?>"><?php echo $prod["Product"]["name"] ?></a>

</p>