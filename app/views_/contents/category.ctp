<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'contents', 'action'=>'index')), 'title'=>'Tin tức');
				$breads[] = array('link'=>'', 'title'=>$cat["ContentCategory"]["name"]);
				
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
			<h2><?php echo $cat["ContentCategory"]["name"] ?></h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			<!--PARAGRAPH WITH IMAGES-->
			<div style="margin-left:10px"></div>			
			<!--SINGLE PROPERTY PAGE-->
			
                <!--PROPERTY DETAILS-->
                        
                        
        <? foreach ($contents as $item):
		$class = null;
	?>
        
        
        <div class="property-detail">
				
				<!--<h2><a href="<?php echo $this->Html->url($item["Content"]["link"]) ?>"><?php echo $item['Content']['name']; ?></a></h2>-->
				<div class="detail-who clear" style="margin:10px 0">

					<div class="who-post">
						<?php if($item["Content"]["image"]) { ?>
							<div class="imgout">
								<a href="<?php echo $this->Html->url($item["Content"]["link"]) ?>"><?php echo $item["Content"]["image"] ? $this->Html->image($item["Content"]["image"], array('title' => $item['Content']['name'])) : "" ; ?></a>
							</div>
						<?php } ?>
						<h4><a href="<?php echo $this->Html->url($item["Content"]["link"]) ?>"><?php echo $item["Content"]["name"]; ?></a>
							<br /><span class="small_date">(<?php echo $item["Content"]["create_date"] ?>)</span>
						</h4>
						<?php echo $item["Content"]["content"]; ?>
                                                <a class="view-more" href="<?php echo $this->Html->url($item["Content"]["link"]) ?>" style="float:right;margin-top:15px">
                                                            <span style="color:#fff">Xem chi tiết</span>
                                                          </a>
                                                                                                          
                                                                                                  </div>
                                                                                          </div>
                                                                  </div>
        
        
                <?php endforeach; ?>
		
		<div class="list-share clear paging">
				<ul>
					
					<li class="bubble">
                                            <?php echo $this->Paginator->prev('<< ' . __('trang trước', true), array(), null, array('class'=>'disabled'));?>
                                        </li>
					<li><?php echo $this->Paginator->numbers(array('separator'=>' '));?></li>
					
					<li class="bubble">
                                            <?php echo $this->Paginator->next(__('trang sau', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                                        </li>

				</ul>
				<ul><li><li>
					
					<label>
                                        <?php
	echo $this->Paginator->counter(array(
	'format' => __('Trang %page%/%pages%, hiển thị %start% - %end% trong %count% BÐS', true)
	));
	?>
                                        </label></li></li></ul>
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

	

