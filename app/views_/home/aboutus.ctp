
		<!--BREADCRUMB-->
		<div class="breadcrumb">
			<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a><span>&nbsp;</span><label>Giới thiệu</label>
		</div>	
		<!--PAGE TITLE-->	
		<div class="page-title">
			<h2>Giới thiệu</h2>
			<?php echo $this->element('sloganline'); ?>
		</div>
	</div>	
	
	<!--BOTTOM CONTENTS-->	
	<div id="bottom-content" class="clear">	
		<!--LEFT CONTENT-->			
		<div class="left-content">		
			<!--ABOUT INTRO TEXT-->
			<div class="meet-our-team">
				<!--<img src="<?php echo $this->Html->url("/img/aboutus/aboutus-img.jpg"); ?>" alt="" title="" />-->
				<?php //echo $intro["Content"]["content"]; ?>
				

				<h2><?php echo $letter["Content"]["name"] ?></h2>
				<?php echo $letter["Content"]["content"] ?>

				
			</div>
			<!--MEET OUR TEAM-->
			<!--<div class="meet-our-team">
				<h2><?php echo $team_expert["Content"]["name"]; ?></h2>
				<ul>
					<li>
						<img src="<?php echo $this->Html->url("/img/aboutus/staff1.jpg"); ?>" alt="" title="" />
						<h4>Maria Thour Fisher</h4>
						<span>Broker, Director</span>						
					</li>
					<li>
						<img src="<?php echo $this->Html->url("/img/aboutus/staff2.jpg"); ?>" alt="" title="" />
						<h4>James Derricks</h4>
						<span>Broker, CEO</span>						
					</li>
					<li>
						<img src="<?php echo $this->Html->url("/img/aboutus/staff3.jpg"); ?>" alt="" title="" />
						<h4>Theresa Fox</h4>
						<span>Realtor, Manager</span>						
					</li>	
					<li class="last">
						<img src="<?php echo $this->Html->url("/img/aboutus/staff4.jpg"); ?>" alt="" title="" />
						<h4>Jessica James</h4>
						<span>Broker, Director</span>						
					</li>	
				</ul>
				<?php echo $team_expert["Content"]["content"]; ?>
			</div>-->
			<!--MISSION AND VISION-->
			<div class="mission-vision">	
				<h2><?php echo $proview["Content"]["name"]; ?></h2>
				<?php echo $proview["Content"]["content"]; ?>
				<!--<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nibh mi, commodo eu, pellentesque ut, blandit rutrum, ligula. Praesent ultricies urna a urna. Quisque massa. Cras ipsum diam, hendrerit id, accumsan sit amet, fermentum vel, dui. Morbi blandit commodo tellus. Aenean tincidunt pharetra leo. Curabitur euismod sollicitudin elit. Donec faucibus lacus nec sapien. Aliquam ipsum nisi, scelerisque et, commodo nec, consectetur vel, tellus. Cras ipsum diam, hendrerit id, accumsan sit amet, fermentum vel, dui. Morbi blandit commodo tellus.
				</p>-->
			</div>
		</div>	
		
		<!--SIDEBARS-->		
		<div class="sidebar">
			<!--CATEGORIES-->
			<?php echo $this->element('categorybox'); ?>
			<!--SIDEBAR PARAGRAPH
			<div class="side-paragraph">
				<h3>Paragraph</h3>
				<p>
					Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
				</p>
				<p>
					Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.
				</p>
			</div>-->
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

	