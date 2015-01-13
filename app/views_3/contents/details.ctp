<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'contents', 'action'=>'index')), 'title'=>'Tin tức');
				$breads[] = array('link'=>'', 'title'=>$content["Content"]["name"]);
				
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
			<h2><?php echo $content["ContentCategory"]["name"] ?></h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			<!--PARAGRAPH WITH IMAGES-->
			<div class="news2" style="height:auto">
			<h3><a href="#"><?php echo $content["Content"]["name"] ?></a></h3>
			<span class="small_date">(<?php echo $content["Content"]["create_date"] ?>)</span>
			
				<?php echo $content["Content"]["content"] ?>
				
			</div>
			<div class="news2" style="height:auto">
			<h3>Tin mới nhất</h3>
			
				<ul>
				<?php foreach($newContents as $c) { ?>
					<li><a href="<?php echo $this->Html->url($c['Content']['link']) ?>"><?php echo $c['Content']['name'] ?></a>
						<span class="small_date">(<?php echo date('d-m-Y', strtotime($c["Content"]["create_date"])); ?>)</span>
					</li>
				<?php } ?>
				</ul>
				
			</div>
						
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

	

