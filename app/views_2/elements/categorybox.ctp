<?php $types = $this->requestAction('types/getTypes'); ?>
<!--<div class="categories typelist">
				<h3>Loại BĐS</h3>
				<form method="GET" action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="type_filter">
				<input type="hidden" name="filter_ctegory_id" id="filter_category_id" />
					<?php foreach($types as $key => $type) : ?>
						<h4><?php echo $type["Type"]["name"]; ?></h4>
						<ul>
							<?php foreach($type["Category"] as $num => $cat) : ?>
								<li><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>$cat["id"],
											 'category'=>strtolower(Inflector::slug($cat['name']))
											)) ?>" onclick=""><?php echo $cat["name"] ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endforeach; ?>
				</form>
				
			</div>-->


<div class="categories typelist">
				<h3>Loại BĐS</h3>

<form method="GET" action="<?php echo $this->Html->url(array('action' => 'index')); ?>" method="POST" id="type_filter">
<input type="hidden" name="filter_ctegory_id" id="filter_category_id" />
<div id="accordion" class="catbox">
	
	<?php $index = -1; foreach($types as $key => $type) : ?>						
		<h3><a href="#"><?php echo $type["Type"]["name"]; ?></a></h3>
		<div>
			<ul>
							<?php foreach($type["Category"] as $num => $cat) : ?>
								<?php
									$class='';
									if(isset($cat_id) && $cat_id == $cat["id"])
									{
										$index = $key;
										$class=' class="cat-active"';
									}
								?>
								<li <?php echo $class; ?>><a href="<?php echo $this->Html->url(
										array(
											 'controller'=>'products',
											 'filter_category_id'=>$cat["id"],
											 'category'=>strtolower(Inflector::slug($cat['name']))
											)) ?>" onclick=""><?php echo $cat["name"] ?></a></li>
							<?php endforeach; ?>
			</ul>
		</div>
	<?php endforeach; ?>
	
</div>
</form>

</div>

<script type="text/javascript">
$(document).ready(function() {
	<?php if($index != 0) { ?>
		$( "#accordion" ).accordion( "activate" , <?php echo $index; ?> );
	<?php } ?>
});
</script>