<?php $projects = $this->requestAction('projects/getNewProjects'); //echo count($projects); ?>
<div class="video newprojects clear">
			<h3>Dự án được quan tâm</h3>
			<!--<div class="project_scrollbar">
				<ul style="width: auto !important">
                                <?php foreach($projects as $project) { ?>
					<li><a title="<?php echo $project["Project"]["name"] ?>" href="<?php echo $this->Html->url($project["Project"]["link"]) ?>"><?php echo $this->Html->image("/uploads/project_image/filename/thumb/feature/".$project["ProjectImage"]["filename"], array('title' => $project["ProjectImage"]["title"], 'width'=>'150px', 'height'=>'90px')); ?>
                                        <span><?php echo $project["Project"]["sname"] ?></span></a><br /><?php echo $project["District"]["name"] ?>, <?php echo $project["City"]["name"] ?>
                                            <div class="smallava">
                                                <?php //echo $project["UserImage"]["filename"] ?>
                                                <?php if(isset($project["UserImage"]["filename"])) {?>
							<?php echo $this->Html->image("/uploads/user_image/filename/thumb/feature/".$project["UserImage"]["filename"], array('title' => $project["UserProfile"]["name"])); ?>
						<?php } else { ?>
							<?php echo $this->Html->image("/img/home/noimage_160x110.jpg", array('title' => $project["UserProfile"]["name"])); ?>
						<?php } ?>
                                            </div>
                                        
                                        </li>
                                <?php } ?>
					
				</ul>
			</div>-->

			
<div class="demo-wrap">

<ul id="slider1">
  <?php foreach($projects as $project) { ?>
					<li><a title="<?php echo $project["Project"]["name"] ?>" href="<?php echo $this->Html->url($project["Project"]["link"]) ?>"><?php echo $this->Html->image("/uploads/project_image/filename/thumb/feature/".$project["ProjectImage"]["filename"], array('title' => $project["ProjectImage"]["title"], 'width'=>'150px', 'height'=>'90px')); ?>
                                        <span><?php echo $project["Project"]["sname"] ?></span></a><br /><?php echo $project["District"]["name"] ?>, <?php echo $project["City"]["name"] ?>
                                            <div class="smallava">
                                                <?php //echo $project["UserImage"]["filename"] ?>
                                                <?php if(isset($project["UserImage"]["filename"])) {?>
							<?php echo $this->Html->image("/uploads/user_image/filename/thumb/feature/".$project["UserImage"]["filename"], array('title' => $project["UserProfile"]["name"])); ?>
						<?php } else { ?>
							<?php echo $this->Html->image("/img/home/noimage_160x110.jpg", array('title' => $project["UserProfile"]["name"])); ?>
						<?php } ?>
                                            </div>
                                        
                                        </li>
<?php } ?>
</ul>
</div>

			</div>