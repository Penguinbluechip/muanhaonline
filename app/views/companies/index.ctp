		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<?php
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'home', 'action'=>'index')), 'title'=>'Trang chủ');
				$breads[] = array('link'=>$this->Html->url(array('controller'=>'companies', 'action'=>'reset')), 'title'=>'Doanh nghiệp');
				
				if($company_cat_id)
				{
					$breads[] = array('link'=>$this->Html->url(
										array(
											 'controller'=>'companies',
											 'filter_category_id'=>$company_cat_id,
											 'category'=>strtolower(Inflector::slug($cat['CompanyCategory']['name']))
											)),
										'title'=>$cat["CompanyCategory"]["name"]);
				}
				
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
			<h2>Doanh nghiệp</h2>
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
                        
                        
        <?
	if(!count($companies)){
		echo '<div class="property-detail">Không tìm thấy doanh nghiệp phù hợp</div>';
	}
	foreach ($companies as $company):
		$class = null;
	?>
        
        
        <div class="property-detail company_item">
				
				
				<div class="detail-who clear">

					<div class="who-postz">
						<?php if(isset($company["CompanyImage"]["filename"])) {?>
								<a href="#" title="<?php echo $company["CompanyImage"]["title"] ?>"><?php echo $this->Html->image("/uploads/company_image/filename/thumb/feature/".$company["CompanyImage"]["filename"], array('style'=>'width: 150px !important; height: 125px !important; float: left; margin-right: 10px;')); ?></a>
						<?php } else { ?>
								<a href="#" title=""><?php echo $this->Html->image("/img/home/noimage_160x110.jpg", array('title' => "BĐS chưa có hình ảnh",'style'=>'width: 150px !important; height: 125px !important; float: left; margin-right: 10px;')); ?></a>
						<?php } ?>
												
						<h4><?php echo $company['Company']['name']; ?></h4>
						<span class="small_date"><?php echo $company['CompanyCategory']['name']; ?></span>
						
						<ul class="room">
							<li><strong><?php echo $company['Company']['address'] ?></strong></li>
							<li style="width: 240px"><strong>Điện thoại:</strong> <?php echo $company['Company']['phone'] ?></li>
							<li style="width: 120px"><strong>Fax:</strong> <?php echo $company['Company']['fax'] ?></li>
							<li><strong>Email:</strong> <?php echo $company['Company']['email'] ?></li>
							<li><strong>Website:</strong> <?php echo $company['Company']['website'] ?></li>
													
						</ul>
						
                                                

						
						
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
	'format' => __('Trang %page%/%pages%, hiển thị %start% - %end% trong %count% doanh nghiệp', true)
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
			<?php //echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH-->
			
			<div style="margin-top:10px" class="video clear company_box">
				<h3>Doanh nghiệp</h3>
				<ul>
					<?php foreach($cats as $cat) { ?>
						<li <?php echo $cat['CompanyCategory']['id'] == $company_cat_id ? 'class="active"' : '';?>><a href="<?php echo $this->Html->url(array('controller'=>'companies', 'action'=>'companiesByCat', $cat['CompanyCategory']['id'])) ?>"><?php echo $cat['CompanyCategory']['name'] ?></a></li>										
					<?php } ?>
				</ul>
			</div>
			
			<?php echo $this->element('quickaddbox'); ?>
			<?php echo $this->element('whoisonline'); ?>	
			
			
		</div>

	
	

















