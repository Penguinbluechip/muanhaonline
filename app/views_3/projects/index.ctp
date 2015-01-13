		
		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'projects', 'action'=>'index')), 'title'=>'Dự án');
				
				foreach($breads as $key => $item) {
			?>
				<?php if($key == count($breads)-1) { ?>
					<label><?php echo $item['title'] ?></label>
				<?php } else { ?>
					<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a> <span>&nbsp;</span>
				<?php } ?>
			<?php } ?>
			 
		</div>	
		
		<div class="page-title">
			<h2>Danh sách dự án</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
		<div class="flash">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->element('underconstruction'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">
		
		
		<!--LEFT CONTENT-->			
		<div class="left-content">
                    <div style="margin-left:10px"></div>			
			<!--SINGLE PROPERTY PAGE-->
			
			<!--PROPERTY DETAILS-->
			<div class="property-detail">
			<div class="banner_duan">
				<?php echo $this->Html->image("/img/home/duanbanner.png", array('width'=>'538px', 'height'=>'213px', 'style'=>'margin-bottom:0')); ?>
			</div>
			</div>
                        
        <? foreach ($projects as $project):
		$class = null;
	?>
        
        
        <div class="property-detail">
				
				
				<div class="detail-who clear" style="margin:10px 0 10px 0">

					<div class="who-post">
						<?php if($project["ProjectImage"]["filename"] != "") {?>
							<div class="imgout">
								<?php echo $this->Html->image("/uploads/project_image/filename/thumb/feature/".$project["ProjectImage"]["filename"], array('title' => $project["ProjectImage"]["title"], 'width'=>'160px', 'height'=>'110px')); ?>
							</div>
						<?php } else { ?>
							<div class="imgout">
								<?php echo $this->Html->image("/img/home/noimage_160x110.jpg", array('title' => "Không có ảnh sản phẩm",'height'=>'110', 'width'=>'160')); ?>
							</div>
						<?php } ?>
						
						<h4><a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($project["City"]["name"])),
													     'id'=>$project["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($project["Project"]["name"])))) ?>"><?php echo $project['Project']['name']; ?></a></h4>
						<span><?php echo $project['Project']['home_number']." ".$project['Project']['street'].", ".$project['District']['name'].", " . $project['City']['name']; ?></span>
						<p><?php echo $project['Project']['sdescription'] ?></p>
						
						<a class="view-more" href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'productsByProject', 'filter_project_id'=>$project["Project"]["id"],'project'=>strtolower(Inflector::slug($project["Project"]["name"])))) ?>" style="float:right;margin-top:5px;margin-left:10px">
  <span style="color:#fff">Xem BĐS thuộc dự án</span>
</a>
						
                                                <a class="view-more" href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($project["City"]["name"])),
													     'id'=>$project["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($project["Project"]["name"])))) ?>" style="float:right;margin-top:5px">
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
			<?php //echo $this->render('_home_filter', '');?>
			<div class="search advanced">
				

					<?php echo $this->render('_home_filter', '');?>
					<?php //echo $this->render('_type_category', '');?>
					

			</div>
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			<?php echo $this->element('newprojects'); ?>
			<?php echo $this->element('whoisonline'); ?>
			<div class="search1">
				
				
			</div>
			
		</div>

	
	

















