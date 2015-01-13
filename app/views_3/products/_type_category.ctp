<div class="categories typelist">
				<h3>Loại BĐS</h3>
				
				<?php foreach($types as $key => $type) : ?>
					<h4><?php echo $type["Type"]["name"]; ?></h4>
					<ul>
						<?php foreach($type["Category"] as $num => $cat) : ?>
							<li><a href="#"><?php echo $cat["name"] ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
				
			</div>lxkjf gkjhkgh skdhks