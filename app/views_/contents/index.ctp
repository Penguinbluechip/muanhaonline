<!--BREADCRUMB-->
		<div class="breadcrumb">
			<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a><span>&nbsp;</span><label>Tin tức</label>
		</div>	
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Chuyên mục tin</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			<!--PARAGRAPH WITH IMAGES-->
			<div class="news2">
			<h3><a href="<?php echo $this->Html->url(array('action'=>'category', 'id'=>2, 'category'=>$tt_sks[0]["ContentCategory"]["name"])) ?>">Tin tức & Sự kiện</a></h3>
			
				
				<div class="paragraph-images1">
					<?php if($tt_sks[0]["Content"]["image"]) { ?>
						<img src="<?php echo $tt_sks[0]["Content"]["image"] ?>" width="280" height="220" alt="" title="" class="left" />
					<?php }else {?>
						<img src="<?php echo $this->Html->url("/img/home/noimage_300x200.jpg"); ?>" width="280" height="220" alt="" title="" class="left" />
					<?php } ?>
					<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($tt_sks[0]["Content"]["link"]) ?>"><?php echo $tt_sks[0]["Content"]["name"] ?></a>
						<span class="small_date">(<?php echo $tt_sks[0]["Content"]["create_date"]; ?>)</span>
					</h4>
					
					<?php echo $tt_sks[0]["Content"]["content"] ?>
				</div>
				
				
				<div class="list_news">
					<?php foreach($tt_sks as $key => $news) { if($key != 0) { ?>
						<div class="small_news">
							<?php if($news["Content"]["image"]) { ?><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><img src="<?php echo $news["Content"]["image"] ?>" alt="" width="75" height="60px" /></a><?php } ?>
							<a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
						</div>
					<?php }} ?>
					
				</div>
			</div>
			
			
			<?php foreach($cats as $cat) { ?>
				<div class="news1">
				<h3><a href="<?php echo $this->Html->url(array('action'=>'category', 'id'=>$cat['ContentCategory']['id'], 'category'=>$cat['ContentCategory']['name'])) ?>"><?php echo $cat['ContentCategory']['name'] ?></a></h3>
					<div class="paragraph-images">
						
						<?php if($cat['items'][0]["Content"]["image"]) { ?><img src="<?php echo $cat['items'][0]["Content"]["image"] ?>" width="140" height="100" alt="" title="" class="left" /><?php } ?>
						<h4><a style="text-decoration:none;color:#C37B38" href="<?php echo $this->Html->url($cat['items'][0]["Content"]["link"]) ?>"><?php echo $cat['items'][0]["Content"]["name"] ?></a>
							<span class="small_date">(<?php echo $cat['items'][0]["Content"]["create_date"] ?>)</span>
						</h4>
						
						<?php echo $cat['items'][0]["Content"]["content"] ?>
					</div>
					<div class="list_news">
						<ul>
							<?php foreach($cat['items'] as $key => $news) { if($key != 0) { ?>
								<li><a href="<?php echo $this->Html->url($news["Content"]["link"]) ?>"><?php echo $news["Content"]["name"] ?></a>
								<span class="small_date">(<?php echo $news["Content"]["create_date"] ?>)</span>
								</li>
							
							<?php }} ?>					
						</ul>
					</div>
				</div>
			
			<?php } ?>
			
			
			
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH
			
			<!--NEWSLETTER-->
			<?php echo $this->element('registerbox'); ?>
			
			<!--MORTGAGE CALCULATOR
			<div class="mortgage-calculator">				
				<h3><a href="#?w=360" rel="calculator" class="poplight">Mortgage Calculator</a></h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
			</div>-->
			<!--VIDEOS-->
			<?php echo $this->element('expertbox'); ?>

		  <?php echo $this->element('whoisonline'); ?>

			

		</div>

	

