<?php $current_city = $this->requestAction('cities/getCurrentCity'); ?>
<?php $cities = $this->requestAction('cities/getAll');?>
<?php $current_district = $this->requestAction('districts/getCurrentDistrict'); ?>
<?php $types = $this->requestAction('types/getTypes'); ?>

<div id="home_rich_filters">
    <ul>
        <li <?php if($current_city['City']['id'] == 1) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>'1',
											 'city'=>'tp_hồ_chi_minh'
											)) ?>">TP.HCM</a></li>
        <li <?php if($current_city['City']['id'] == 34) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>'34',
											 'city'=>'hà_nội'
											)) ?>">HÀ NỘI</a></li>
        
	<li <?php if($current_city['City']['id'] == 17) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>'17',
											 'city'=>'bình_dương'
											)) ?>">BÌNH DƯƠNG</a></li>
	
	<li <?php if($current_city['City']['id'] == 47) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>'47',
											 'city'=>'hải_phòng'
											)) ?>">HẢI PHÒNG</a></li>
	<li <?php if($current_city['City']['id'] == 2) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>'2',
											 'city'=>'đà_nẵng'
											)) ?>">ĐÀ NẴNG</a></li>
											
	<?php if($current_city['City']['id'] && !in_array($current_city['City']['id'], array(1, 2, 17, 34, 47))) { ?>
	    <li class="active"><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_city_id'=>$current_city['City']['id'],
											 'city'=>strtolower(Inflector::slug($current_city['City']['name']))
											)) ?>"><?php echo $current_city['City']['name'] ?></a></li>
	<?php } ?>
	
	<li id="more_city" class="arrow_down"><a href="#opencbox" onclick="if($('#city_list').css('display') == 'none') {$('#city_list').fadeIn(); $('#more_city').addClass('arrow_down_close'); } else {$('#city_list').fadeOut(); $('#more_city').removeClass('arrow_down_close');}">></a></li>
	
    </ul>    
</div>
<div id="city_list">
<h2>DANH SÁCH CÁC TỈNH/THÀNH</h2>
    <ul>
	<?php foreach($cities as $city) { ?>
	    <li <?php if($current_city['City']['id'] == $city['City']['id']) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										    array(
											     'controller'=>'products',
											     'filter_city_id'=>$city['City']['id'],
											     'city'=>strtolower(Inflector::slug($city['City']['name']))
											    )) ?>"><?php echo $city['City']['name']; ?></a></li>
	<?php } ?>
    </ul>
</div>


<?php if($current_city) { ?>

<div id="home_rich_filters_district">
    <ul>
    <li class="all_dist <?php if(!$current_district) echo 'active' ?>" ><a href="<?php echo $this->Html->url(
										    array(
											     'controller'=>'products',
											     'filter_city_id'=>$current_city['City']['id'],
											     'city'=>strtolower(Inflector::slug($current_city['City']['name']))
											    )) ?>">Tất cả</a></li>
    <?php foreach($current_city['District'] as $dist) { ?>
	<li <?php if($current_district['District']['id'] == $dist['id']) echo 'class="active" ' ?>><a href="<?php echo $this->Html->url(
										    array(
											     'controller'=>'products',
											     'filter_city_id'=>$current_city['City']['id'],
											     'city'=>strtolower(Inflector::slug($current_city['City']['name'])),
											     'filter_district_id'=>$dist['id'],
											     'district'=>strtolower(Inflector::slug($dist['name']))
											    )) ?>"><?php echo $dist['name']; ?></a></li>
    <?php } ?>
    </ul>
</div>

<?php } ?>

<div id="home_rich_filters_cats">
				<!--<h3>Loại BĐS</h3>-->

<form method="GET" action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="type_filter">
<input type="hidden" name="filter_ctegory_id" id="filter_category_id" />
<div id="" class="catbox">
    <ul>
	<li  class="all_dist <?php if(isset($cat_id) && ($cat_id == 0 || $cat_id == "")) echo "active" ?>"><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>"0",
											 'category'=>'tat_ca'
											)) ?>" onclick="">Tất cả</a></li>
	<?php $index = -1; foreach($types as $key => $type) : ?>				
		
			
							<?php foreach($type["Category"] as $num => $cat) : ?>
								<?php
									$class='';
									if(isset($cat_id) && $cat_id == $cat["id"])
									{
										$index = $key;
										$class=' class="cat-active active"';
									}
								?>
								<li <?php echo $class; ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>$cat["id"],
											 'category'=>strtolower(Inflector::slug($cat['name']))
											)) ?>" onclick=""><?php echo $cat["name"] ?></a></li>
							<?php endforeach; ?>


	<?php endforeach; ?>
    </ul>
</div>
</form>

</div>

<!--<div id="home_rich_filters_order">
				

<form method="GET" action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="type_filter">
<input type="hidden" name="filter_ctegory_id" id="filter_category_id" />
<div id="" class="catbox">
    <ul>
	<li  class="all_dist <?php if(isset($cat_id) && ($cat_id == 0 || $cat_id == "")) echo "active" ?>"><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>"0",
											 'category'=>'tat_ca'
											)) ?>" onclick="">Tất cả</a></li>
	<?php $index = -1; foreach($types as $key => $type) : ?>				
		
			
							<?php foreach($type["Category"] as $num => $cat) : ?>
								<?php
									$class='';
									if(isset($cat_id) && $cat_id == $cat["id"])
									{
										$index = $key;
										$class=' class="cat-active active"';
									}
								?>
								<li <?php echo $class; ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>$cat["id"],
											 'category'=>strtolower(Inflector::slug($cat['name']))
											)) ?>" onclick=""><?php echo $cat["name"] ?></a></li>
							<?php endforeach; ?>


	<?php endforeach; ?>
    </ul>
</div>
</form>

</div>
-->
<br style="clear: both" />