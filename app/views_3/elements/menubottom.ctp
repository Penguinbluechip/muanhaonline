
						<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'index')) ?>">Trang chủ</a>
                                                /
						
							<a href="<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'products') echo ' class="activelink"'; ?>>Bất động  sản</a>
								
						
                                                /
						
							<a href="<?php echo $this->Html->url(array('controller'=>'projects', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'projects') echo ' class="activelink"'; ?>>Dự án</a>
                                                        
							
						
                                                /
                        <a href="<?php echo $this->Html->url(array('controller'=>'contents')) ?>" <?php if($this->params['controller'] == 'contents') echo ' class="activelink"'; ?>>Tin tức</a>
			
				
				
			
                        /
						
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
						<a href="<?php echo $this->Html->url(array('controller'=>'companies', 'action'=>'reset')) ?>" <?php if($this->params['controller'] == 'companies') echo ' class="activelink"'; ?>>Doanh nghiệp</a>
							
						
                                                /
                                                    
						<a href="<?php echo $this->Html->url(array('controller'=>'home', 'action'=>'aboutus')) ?>" <?php if($this->params['controller'] == 'home' && $this->params['action'] == 'aboutus') echo ' class="activelink"'; ?>>Giới thiệu</a>
                                                
                                                /
                                                
						<a href="<?php echo $this->Html->url(array('controller'=>'contacts', 'action'=>'view', 'id'=>"1")) ?>" <?php if(($this->params['controller'] == 'contacts' && $this->params['action'] == 'view') || ($this->params['controller'] == 'customers' && $this->params['action'] == 'contact')) echo ' class="activelink"'; ?>>Liên hệ</a>
                                                /
                                                <a target="_blank" href="https://mail.google.com/a/muanhaonline.com.vn" <?php if(($this->params['controller'] == 'contacts' && $this->params['action'] == 'view') || ($this->params['controller'] == 'customers' && $this->params['action'] == 'contact')) echo ' class="activelink"'; ?>>Hộp thư</a>
