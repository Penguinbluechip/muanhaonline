<?php
$categories = $this->requestAction('categories/getAll');
$pcategories = $this->requestAction('project_categories/getAll');
$companyCategories = $this->requestAction('company_categories/getAll');
?>

<ul class="sf-menu">
						<li><a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>" <?php if($this->params['controller'] == 'home' && $this->params['action'] == 'index') echo ' class="activelink"'; ?>>Trang chủ</a></li>
						<li>
							<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'products') echo ' class="activelink"'; ?>>Bất động  sản</a>
								<ul>
									<?php foreach($categories as $cat) { ?>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'productsByCategory', $cat['Category']['id'])) ?>"><?php echo $cat['Category']['name'] ?></a></li>										
									<?php } ?>	
										
								</ul>
						</li>
						<li>
							<a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'projects') echo ' class="activelink"'; ?>>Dự án</a>
                                                        <ul>
									<?php foreach($pcategories as $cat) { ?>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'getProjectByCategory', $cat['ProjectCategory']['id'])) ?>"><?php echo $cat['ProjectCategory']['name'] ?></a></li>										
									<?php } ?>	
										
								</ul>
							
						</li>
                        <li><a href="<?php echo $this->Html->url(array('controller'=>'contents')) ?>" <?php if($this->params['controller'] == 'contents') echo ' class="activelink"'; ?>>Tin tức</a>
			
				<ul>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>2, 'category'=>'Tin tức sự kiện')) ?>">Tin tức & sự kiện</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>6, 'category'=>'Tin tức BĐS')) ?>">Tin tức BĐS</a></li>
						
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>4, 'category'=>'Kiến trúc')) ?>">Kiến trúc</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>3, 'category'=>'Phong thủy')) ?>">Phong thủy</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>5, 'category'=>'Pháp lý')) ?>">Pháp lý</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>7, 'category'=>'Thông tin quy hoạch')) ?>">Thông tin quy hoạch</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action'=>'category', 'id'=>8, 'category'=>'Thông tin dự án')) ?>">Thông tin dự án</a></li>
								
				</ul>
				
			</li>
						
						<!--<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>" <?php if(($this->params['controller'] == 'users' && $this->params['action'] == 'register') || ($this->params['controller'] == 'user_profiles')) echo ' class="activelink"'; ?>>Thành viên</a>
								
										<?php if (!empty($user)) { ?>
										<ul>
												<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'register', 1)) ?>" <?php if(($this->params['controller'] == 'users' && $this->params['action'] == 'register') || ($this->params['controller'] == 'user_profiles')) echo ' class="activelink"'; ?>>Sửa thông tin</a></li>
										
												<?php if ($group["Group"]["id"] == 2) { ?>																	
														<li><?php echo $this->Html->link(__('Phần quản trị', true), array('controller' => 'products', 'action' => 'index', 'manager'=>true)); ?></li>																											
												<?php } ?>
										</ul>
										<?php } ?>
								
						</li>-->
						<li><a href="<?php echo $this->Html->url(array('controller'=>'companies', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'companies') echo ' class="activelink"'; ?>>Doanh nghiệp</a>
							<ul>
								<?php foreach($companyCategories as $cat) { ?>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'companies', 'action'=>'companiesByCat', $cat['CompanyCategory']['id'])) ?>"><?php echo $cat['CompanyCategory']['name'] ?></a></li>										
								<?php } ?>
							</ul>
						</li>
						
						<li><a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'aboutus')) ?>" <?php if($this->params['controller'] == 'home' && $this->params['action'] == 'aboutus') echo ' class="activelink"'; ?>>giới thiệu</a></li>

						<li><a href="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', 'id'=>"1")) ?>" <?php if(($this->params['controller'] == 'contacts' && $this->params['action'] == 'view') || ($this->params['controller'] == 'customers' && $this->params['action'] == 'contact')) echo ' class="activelink"'; ?>>Liên hệ</a></li>
					</ul>