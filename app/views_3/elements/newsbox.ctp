<?php
$newses1 = $this->requestAction('contents/getCategoryNewses/2');
$newses2 = $this->requestAction('contents/getCategoryNewses/3');
$newses3 = $this->requestAction('contents/getCategoryNewses/4');
$newses4 = $this->requestAction('contents/getCategoryNewses/6');
$newses5 = $this->requestAction('contents/getCategoryNewses/5');
//var_dump($tt_sks);
?>

<div id="tabs" style="margin:0 -10px 10px -10px;">
	<ul>
		<li><a href="#tabs-1">Tin tức & Sự kiện</a></li>
		<li><a href="#tabs-2">Tin tức BĐS</a></li>
		<li><a href="#tabs-3">Phong thủy</a></li>
		<li><a href="#tabs-4">Kiến trúc</a></li>
		<li><a href="#tabs-5">Pháp lý</a></li>
	</ul>
	<div id="tabs-1">
            <div class="news21">			
				<div class="paragraph-images1">
					<?php if($newses1[0]["Content"]["image"]) { ?>
						<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses1[0]["Content"]["link"]) ?>">
							<img src="<?php echo $newses1[0]["Content"]["image"] ?>" alt="" title="" class="left" />
						</a>
						
					<?php } else { ?>
						<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses1[0]["Content"]["link"]) ?>">
							<img src="<?php echo $this->Html->url('/img/home/noimage_300x200.jpg') ?>" alt="" title="" class="left" />
						</a>
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses1[0]["Content"]["link"]) ?>"><?php echo $newses1[0]["Content"]["name"] ?></a></h4>
					<?php echo $newses1[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($newses1 as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<!--<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>-->
							- <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
	    </div>
	</div>
	<div id="tabs-2">
		<div class="news21">			
				<div class="paragraph-images1">
					<?php if($newses4[0]["Content"]["image"]) { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses4[0]["Content"]["link"]) ?>">
						<img src="<?php echo $newses4[0]["Content"]["image"] ?>" alt="" title="" class="left" />
					</a>
					<?php } else { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses4[0]["Content"]["link"]) ?>">
						<img src="<?php echo $this->Html->url('/img/home/noimage_300x200.jpg') ?>" alt="" title="" class="left" />
					</a>
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses4[0]["Content"]["link"]) ?>"><?php echo $newses4[0]["Content"]["name"] ?></a></h4>
					<?php echo $newses4[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($newses4 as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<!--<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news4["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>-->
							- <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
	    </div>
	</div>
	<div id="tabs-3">
		<div class="news21">			
				<div class="paragraph-images1">
					<?php if($newses2[0]["Content"]["image"]) { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses2[0]["Content"]["link"]) ?>">
						<img src="<?php echo $newses2[0]["Content"]["image"] ?>" alt="" title="" class="left" />
					</a>
					<?php } else { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses2[0]["Content"]["link"]) ?>">
						<img src="<?php echo $this->Html->url('/img/home/noimage_300x200.jpg') ?>" alt="" title="" class="left" />
					</a>
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses2[0]["Content"]["link"]) ?>"><?php echo $newses2[0]["Content"]["name"] ?></a></h4>
					<?php echo $newses2[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($newses2 as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<!--<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>-->
							- <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
	    </div>
	</div>
	<div id="tabs-4">
		<div class="news21">			
				<div class="paragraph-images1">
					<?php if($newses3[0]["Content"]["image"]) { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses3[0]["Content"]["link"]) ?>">
						<img src="<?php echo $newses3[0]["Content"]["image"] ?>" alt="" title="" class="left" />
					</a>
					<?php } else { ?>
						<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses3[0]["Content"]["link"]) ?>">
							<img src="<?php echo $this->Html->url('/img/home/noimage_300x200.jpg') ?>" alt="" title="" class="left" />
						</a>
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses3[0]["Content"]["link"]) ?>"><?php echo $newses3[0]["Content"]["name"] ?></a></h4>
					<?php echo $newses3[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($newses3 as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<!--<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>-->
							- <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
	    </div>
	</div>
	<div id="tabs-5">
		<div class="news21">			
				<div class="paragraph-images1">
					<?php if($newses5[0]["Content"]["image"]) { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses5[0]["Content"]["link"]) ?>">
						<img src="<?php echo $newses5[0]["Content"]["image"] ?>" alt="" title="" class="left" />
					</a>
					<?php } else { ?>
					<a class="imgout" style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses5[0]["Content"]["link"]) ?>">
						<img src="<?php echo $this->Html->url('/img/home/noimage_300x200.jpg') ?>" alt="" title="" class="left" />
					</a>
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($newses2[0]["Content"]["link"]) ?>"><?php echo $newses5[0]["Content"]["name"] ?></a></h4>
					<?php echo $newses5[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($newses5 as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<!--<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>-->
							- <a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
	    </div>
	</div>
</div>