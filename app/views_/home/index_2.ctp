<script type="text/javascript">
	function changeCurrency(id, value, current)
	{
	    $('#currency_control_'+id+' a').attr('class', '');
	    current.setAttribute("class", "active");
	    
	    
	    $('#product-price_'+id).html(value);
	}	

	$(function() {
		
		//auto scroller
		var checking = setInterval(function() {
				//alert("hehe");
				//alert(("-"+($(".slides ul").css('width').split("px")[0]-931)+"px"));
				if($(".slides ul").css('left') == "-"+($(".slides ul").css('width').split("px")[0]-931)+"px")
				{
						$(".slides ul").css('left', '0px')
						
				}
		},100);

		
		
	});	
</script>
		<div class="flash">
			<?php echo $this->Session->flash()?>
			<?php echo $this->element('underconstruction');?>			
		</div>
		<!--NAVIGATION THUMBS-->		
		<div class="nav-thumbs clear feature_thumb">
			<ul id="navigation-feature">
                            
                                <?php foreach ($specialProducts as $key => $item): ?>
                            
				<li id="feature-tab<?php echo $key+1; ?>"  <?php if($key == 6) echo 'class="last"'; ?>><a href="#" class="<?php if(!$key) echo 'active'; ?>"><img src="<?php echo $this->Html->url("/uploads/product_image/filename/thumb/feature/".$item["ProductImage"][0]["filename"]) ?>" alt="" title="" width="106" height="72" /></a></li>
				
                                
                                <?php endforeach; ?>
			</ul>
		</div>
                <!--FEATURED CONTENT-->	
		<ul id="feature">
			
                        <?php foreach ($specialProducts as $key => $item): ?>
                        
                        <li style="display:<?php if(!$key) echo 'list-item'; else echo 'none'; ?>;" id="feature<?php echo $key+1; ?>">
				<div class="featured-content">

					<div class="featured-image">
						<div class="imgout">
							<img src="<?php echo $this->Html->url("/uploads/product_image/filename/".$item["ProductImage"][0]["filename"]) ?>" alt="" />
						</div>
						<span style="cursor:pointer" onclick="window.location='<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>';" class="shadow">&nbsp;</span>
						<span class="featured-title"><?php echo $item["Product"]["name"]; ?></span>
					</div>
					<div class="content">
						<div class="home_top_content">
							<h2><?php echo $item["Product"]["name"]; ?></h2>
							
							<?php echo $item["Product"]["description"]; ?>
						</div>
						
						<div class="bottom_home_price">
							<div class="details">
								<?php if($item['Type']['id'] != 3) { ?>
									<label class="bedrooms"><?php echo $item["Product"]["bedrooms"]; ?> Phòng ngủ</label>
									<label class="bathrooms"><?php echo $item["Product"]["bathrooms"]; ?> Phòng tắm</label>
								<?php } else { ?>
									<label class="">Diện tích: <?php echo $item["Product"]["lot_area"]; ?>m2</label>
								<?php } ?>
								
							</div>
							<a style="margin-top:-5px;" href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
														     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
														     'id'=>$item["Product"]["id"],
														     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>"><span>Xem chi tiết</span></a>
	
							<?php if($item['Product']['price']) { ?>
								<span class="currency_control_out" id="product-price_<?php echo $item["Product"]["id"] ?>"><?php echo $item["prices"][$item["CurrencyPrice"]["id"]]["value"]; ?>&nbsp;</span>
								  <span class='currency_control' style="margin-right:5px" id="currency_control_<?php echo $item["Product"]["id"] ?>">
									  <?php foreach($item["prices"] as $cu) { ?>
										  <a href="#chang_cur" class='<?php echo $cu['id'] == $item["CurrencyPrice"]["id"] ? 'active' : ''; ?>' onclick="changeCurrency('<?php echo $item["Product"]["id"] ?>', '<?php echo $cu["value"] ?>', this)"> <?php if($cu['id'] != 2) echo "|"; ?> <?php echo $cu["code"] ?></a>
									  <?php } ?>
								  </span>
							<?php } else { ?>
								<span>giá thương lượng &nbsp;</span>
							<?php } ?>
						</div>
					</div>
				</div>	
			</li>
                        
                        <?php endforeach; ?>
                        
                        
			
		</ul>			
		
		
		<div class="nav-thumbs clear">
			<div class="topslider">
				<div class="wt-scroller">
					<div class="prev-btn"></div>          
					<div class="slides">
					<ul>
						<?php foreach ($topProducts as $key => $item): ?>
							<li>
								<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>" rel="scroller">
							<img src="<?php echo isset($item["ProductImage"][0]) ? $this->Html->url("/uploads/product_image/filename/thumb/feature/".$item["ProductImage"][0]["filename"]) : $this->Html->url("/img/home/noimage_160x110.jpg"); ?>" title="<?php echo $item["Product"]["name"]; ?>" alt="<?php echo $item["Product"]["name"]; ?>"/></a>
								<p><?php echo $item["Product"]["name"]; ?></p>               
							</li>   
                                
						<?php endforeach; ?>
					
			
					    
					    
			
						      
					</ul>
					</div>          	
					<div class="next-btn"></div>
					<div class="lower-panel"></div>
					</div>   
			</div>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			<!--WELCOME MESSAGE-->
			<?php echo $this->element('homenewsslide'); ?>
			<div class="welcome-msg">

				<h2><?php echo $welcome["Content"]["name"] ?></h2>
				
				<?php echo $welcome["Content"]["content"] ?>
				
				
				<?php echo $this->element('newsbox'); ?>
				
				
				
				
				
			</div>			
			<!--FOR RENT AND FOR SALE-->			
			<div class="for clear">

				<div class="for-sale">
					<h2>Bất động sản bán</h2>
					<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'forSale')) ?>" class="view-more"><span>Thêm</span></a>
					<ul>
                                                <?php foreach ($salesProducts as $key => $item): ?>
                                            
                                                    <li>
								<?php if(count($item["ProductImage"])) {?>
									<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>" title="<?php echo $item["Product"]["name"]; ?>">
										<img src="<?php echo $this->Html->url("/uploads/product_image/filename/thumb/default/".$item["ProductImage"][0]["filename"]) ?>" width="69" height="63" alt="<?php echo $item["Product"]["name"]; ?>" title="<?php echo $item["Product"]["name"]; ?>" />
									</a>
								<?php } else { ?>
									<?php echo $this->Html->image("/img/home/noimage_69x63.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'63', 'width'=>'69')); ?>
								<?php } ?>
                                                            
                                                            <h3><a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>" title="<?php echo $item["Product"]["name"]; ?>">
							    
							    <?php echo $item["Product"]["sname"]; ?></a></h3>
								
								<?php if($item['Product']['price']) { ?>
									<span class="home_price"><?php echo $item["Product"]["price"]; ?>&nbsp;</span>
								<?php } else { ?>
									<span class="home_price">giá thương lượng &nbsp;</span>
								<?php } ?>
							    
                                                            <p>
					<?php echo $item["Product"]["sdescription"] ?>		    
							    
							    
							    </p>
                                                    </li>                                                                                                  
                                                <?php endforeach; ?>
                                                
					</ul>
				</div>
				<div class="for-rent">
					<h2>Bất động sản thuê</h2>
					<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'forRent')) ?>" class="view-more"><span>Thêm</span></a>
					<ul>

						<?php foreach ($leasingProducts as $key => $item): ?>
                                            
                                                    <li>
								<?php if(count($item["ProductImage"])) {?>
									<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>"  title="<?php echo $item["Product"]["name"]; ?>">
										<img src="<?php echo $this->Html->url("/uploads/product_image/filename/thumb/default/".$item["ProductImage"][0]["filename"]) ?>" width="69" height="63" alt="<?php echo $item["Product"]["name"]; ?>" title="<?php echo $item["Product"]["name"]; ?>" />
									</a>
								<?php } else { ?>
									<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>"  title="<?php echo $item["Product"]["name"]; ?>"><?php echo $this->Html->image("/img/home/noimage_69x63.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'63', 'width'=>'69')); ?></a>
								<?php } ?>
                                                            <h3><a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($item["City"]["name"])),
													     'id'=>$item["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($item["Product"]["name"])))) ?>"  title="<?php echo $item["Product"]["name"]; ?>">
							    
				<?php echo $item["Product"]["sname"]; ?>		    
							    
							    
							    </a></h3>
    
                                                            <?php if($item['Product']['price']) { ?>
									<span class="home_price"><?php echo $item["Product"]["price"]; ?>&nbsp;</span>
								<?php } else { ?>
									<span class="home_price">giá thương lượng &nbsp;</span>
								<?php } ?>
                                                            <p>
							    
							    
							    <?php echo $item["Product"]["sdescription"]; ?>
							    
							    
							    </p>
                                                    </li>                                                                                                  
                                                <?php endforeach; ?>					
					</ul>
				</div>
			</div>

			<!--RECENT BLOG-->
			<div class="our-blog clear">
				<h2>Bất động sản được xem nhiều nhất</h2>
				<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'index')) ?>" class="view-more"><span>Xem thêm</span></a>
				<ul>
					
					<?php foreach ($newProducts as $key => $item): ?>
						<li>
								<?php if(count($item["ProductImage"])) {?>
									<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',$item["Product"]["id"])) ?>"  title="<?php echo $item["Product"]["name"]; ?>"><img src="<?php echo $this->Html->url("/uploads/product_image/filename/thumb/default/".$item["ProductImage"][0]["filename"]) ?>" width="69" height="63" alt="<?php echo $item["Product"]["name"]; ?>" title="<?php echo $item["Product"]["name"]; ?>" /></a>
								<?php } else { ?>
									<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',$item["Product"]["id"])) ?>"  title="<?php echo $item["Product"]["name"]; ?>"><?php echo $this->Html->image("/img/home/noimage_69x63.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'63', 'width'=>'69')); ?></a>
								<?php } ?>
							<h3><a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'details',$item["Product"]["id"])) ?>"  title="<?php echo $item["Product"]["name"]; ?>">
								<?php echo $item["Product"]["sname"]; ?>
							</a></h3>
	
							<p>
								
							<?php echo $item["Product"]["sdescription"] ?>		
								
							</p>
						</li>
                                            
                                                                                                                                                    
                                        <?php endforeach; ?>	
					
					
					
				</ul>
			</div>
		</div>		
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			
			<!--SEARCH PROPERTIES-->
			<?php echo $this->render('_home_filter', '');?>
			<?php echo $this->element('searchbox');?>
			<!--NEWSLETTER-->
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('whoisonline'); ?>
			
			
			<?php echo $this->element('expertbox'); ?>
			<?php echo $this->element('newprojects'); ?>
			<?php //echo $this->element('pricerate'); ?>
			
			
			<div class="video clear">
				<h3>Đối tác</h3>
				<ul>
					<li><a target="_blank" href="http://hoangkhang.com.vn" title="Công TNHH Giải Pháp CNTT và Truyền Thông Hoàng Khang"><img src="img/partner/hoangkhang_incotech.png" alt="" /></a></li>
					<li><a target="_blank" href="http://www.hqa.com.vn/"><img src="img/partner/HoangQuan.jpg" alt="" /></a></li>

					<li><a href=""><img src="img/partner.png" alt="" /></a></li>
					<li><a href=""><img src="img/partner.png" alt="" /></a></li>
				</ul>
			</div>
			
			<div class="video clear" style="display: none"><?php //echo $this->element('counter'); ?></div>
			
			
		</div>
