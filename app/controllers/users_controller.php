<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('SwiftMailer', 'RequestHandler'); 

	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
                //var_dump($this->User->read(null, $id));
		$this->set('u', $this->User->read(null, $id));
	}

	function admin_add() {
            $this->redirect(array('action'=>'add', 'admin'=>false));
		if (!empty($this->data)) {
			$this->data['User']['confirm_password'] = $this->Auth->password($this->data['User']['password']);
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$uu = $this->User->read(null, $id);
			$this->data['User']['confirm_password'] = $uu['User']['password'];
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$companies = $this->User->Company->find('list');
		$districts = $this->User->District->find('list', array('conditions'=>array('city_id'=>'1')));
		
		$this->set(compact('groups', 'companies', 'districts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

        
        
        
        
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('getExpertStatus', 'getNotifications', 'testmail','logout', 'add', "captcha_test", 'dashboard', 'getAdminFixpriceSideBarCount', 'admin_login', 'expert_login', 'manager_login', 'register', 'ajax_register', 'getUser', 'whoisonline', 'forget_password', 'onlines', 'autoOnline', 'captcha', 'getExpertSideBarCount', 'getFixpriceSideBarCount', 'getUserFixpriceSideBarCount', 'supervisor_login', 'inspector_login');
    }
    
    public function captcha()
    {
	$captcha = new SimpleCaptcha();



	// OPTIONAL Change configuration...
	//$captcha->wordsFile = 'words/es.php';
	//$captcha->session_var = 'secretword';
	//$captcha->imageFormat = 'png';
	//$captcha->scale = 3; $captcha->blur = true;
	//$captcha->resourcesPath = "/var/cool-php-captcha/resources";
	
	// OPTIONAL Simple autodetect language example
	/*
	if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	    $langs = array('en', 'es');
	    $lang  = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	    if (in_array($lang, $langs)) {
		$captcha->wordsFile = "words/$lang.php";
	    }
	}
	*/
	
	
	
	// Image generation
	$captcha->CreateImage();
    }
    
    public function register($first = 0) {
        $this->layout = "home";
        Controller::loadModel('Content');
        
        $user = $this->Auth->user();
        if (!empty($user)) {
          $this->redirect(array('controller'=>'user_profiles','action'=>'edit_profile'));
        }
        
        //Captcha
        //App::import('Vendor', 'recaptcha', array('file' => 'recaptchalib.php'));
        //$privatekey = "6LckqMkSAAAAACd8qyHu0GlzRFN1SiRYMv-jagL9";
        //$c = isset($_POST["recaptcha_challenge_field"]) ? $_POST["recaptcha_challenge_field"] : '';
        //$r = isset($_POST["recaptcha_response_field"]) ? $_POST["recaptcha_response_field"] : '';
        //$resp = recaptcha_check_answer($privatekey,
        //                              $_SERVER["REMOTE_ADDR"],
        //                              $c,
        //                              $r);
	
	if($this->data['User']['ver_code']==$this->Session->read('ver_code'))	{ //comparing both codes
		$resp = true;
	}	else	{
		$resp = false;
	}
      
        
        
        
        
        if (!empty($this->data)) {
            
                $this->data["User"]["group_id"] = 2;
                
                $this->data['User']['confirm_password'] = $this->Auth->password($this->data['User']['confirm_password']);
                $this->User->create();
		$this->User->set($this->data);
		$this->User->UserProfile->set($this->data);
                if ($this->User->validates() & $this->User->UserProfile->validates()) {
			//save new user id
			$this->Session->write("new_user_id", $this->User->id);
		    
			if ($resp) {
			    //Save user and user profile
			    $this->User->save($this->data);
			    $this->data["UserProfile"]["user_id"] = $this->User->id;
			    $this->User->UserProfile->save($this->data);
			    
			    //Save Image var_dump($this->data["UserImage"]);
				$this->data["UserImage"]["user_profile_id"] = $this->User->UserProfile->id;
				Controller::loadModel('UserImage');
				$this->UserImage->create();
				if ($this->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			    
			    $this->Session->write("new_register", "1");
			    $this->Session->setFlash(__('Bạn đã tạo tài khoản thành công. Hãy đăng nhập để tiếp tục sử dụng dịch vụ', true));
			    $this->redirect(array('controller'=>'users','action'=>'login'));
			}
			else
			{
			    if(!$first)
				$this->Session->setFlash('Mã bảo mật không chính xác');
				
				$this->data['User']['password'] = '';
				$this->data['User']['confirm_password'] = '';
			
			}
                } else {
                    $this->data['User']['password'] = '';
                    $this->data['User']['confirm_password'] = '';
                    $this->Session->setFlash('Đã có lỗi. Vui lòng kiểm tra lại nội dung đăng ký.');            
                }
            
        
      }
      $rule = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'8'
							)
						)
					);
      
	
	App::import("Component","Captcha"); //including captcha class
	$this->Captcha =  new CaptchaComponent(); //creating an object instance
	$this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
	$this->set('captcha_src',$captcha_src=$this->Captcha->create());
	
      $this->set('groups', $this->User->Group->find('list'));
      //$this->set('companies', $this->User->Company->find('list'));
      $this->set('rule', $rule);
    }
    
    public function ajax_register($first = 0) {
        $this->layout = null;
	
        Controller::loadModel('Content');
        
        $user = $this->Auth->user();
        if (!empty($user)) {
          $this->redirect(array('controller'=>'user_profiles','action'=>'edit_profile'));
        }

	if($this->data['User']['ver_code']==$this->Session->read('ver_code'))	{ //comparing both codes
		$resp = true;
	}	else	{
		$resp = false;
	}

        if (!empty($this->data)) {
            
                $this->data["User"]["group_id"] = 2;
                
                $this->data['User']['confirm_password'] = $this->Auth->password($this->data['User']['confirm_password']);
                $this->User->create();
		$this->User->set($this->data);
		$this->User->UserProfile->set($this->data);
                if ($this->User->validates() & $this->User->UserProfile->validates()) {
			//save new user id
			$this->Session->write("new_user_id", $this->User->id);
		    
			if ($resp) {
			    //Save user and user profile
			    $this->User->save($this->data);
			    $this->data["UserProfile"]["user_id"] = $this->User->id;
			    $this->User->UserProfile->save($this->data);
			    
			    //Save Image var_dump($this->data["UserImage"]);
				$this->data["UserImage"]["user_profile_id"] = $this->User->UserProfile->id;
				Controller::loadModel('UserImage');
				$this->UserImage->create();
				if ($this->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			    
			    $this->Session->write("new_register", "1");
			    $this->Session->setFlash(__('Bạn đã tạo tài khoản thành công. Hãy đăng nhập để tiếp tục sử dụng dịch vụ', true));
			    $this->redirect(array('controller'=>'users','action'=>'login'));
			}
			else
			{
			    if(!$first)
				$this->Session->setFlash('Mã bảo mật không chính xác');
				
				$this->data['User']['password'] = '';
				$this->data['User']['confirm_password'] = '';
			
			}
                } else {
                    $this->data['User']['password'] = '';
                    $this->data['User']['confirm_password'] = '';
                    $this->Session->setFlash('Đã có lỗi. Vui lòng kiểm tra lại nội dung đăng ký.');            
                }
            
        
      }
      $rule = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'8'
							)
						)
					);
      
	
	App::import("Component","Captcha"); //including captcha class
	$this->Captcha =  new CaptchaComponent(); //creating an object instance
	$this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
	$this->set('captcha_src',$captcha_src=$this->Captcha->create());
	
      $this->set('groups', $this->User->Group->find('list'));
      //$this->set('companies', $this->User->Company->find('list'));
      $this->set('rule', $rule);
    }
    
    function manager_changepassword()
    {
	
		$user = $this->Auth->user();
		$user = $this->User->read(null, $user['User']['id']);
		if (!empty($this->data)) {
			if($user['User']['password'] != $this->Auth->password($this->data['User']['old_password']))
			{
				$this->Session->setFlash(__('Mật khẩu đang dùng không đúng.', true));
			}
			else
			{
				if($this->data['User']['new_password'] != $this->data['User']['new_password_confirm'])
				{
					$this->Session->setFlash(__('Xác nhận mật khẩu mới không đúng', true));
				}
				else
				{
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password']);
					$this->data['User']['confirm_password'] = $this->data['User']['password'];
					if ($this->User->save($this->data)) {
						$this->Session->setFlash(__('Mật khẩu đã được thay đổi thành công', true));
						$this->redirect(array('controller'=>'products', 'action' => 'index'));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
					}					
				}				
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $user['User']['id']);
			$this->data['User']['confirm_password'] = $this->data['User']['password'];
		}
		
		//count bds
		Controller::loadModel('Product');
		
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
    }
    
    function forget_password()
    {
	$this->layout = 'home';
	if (!empty($this->data)) {
		if(!empty($this->data['User']['re_username']))
		{
			$user = $this->User->find('first', array('conditions'=>array('User.username'=>$this->data['User']['re_username'])));
		}
		else
		{
			$user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['re_email'])));
		}
			
			if(!empty($user))
			{
				//var_dump($user);
				$rand_password = $this->User->createRandomPassword();
				$user['User']['password'] = $this->Auth->password($rand_password);
				$user['User']['confirm_password'] = $user['User']['password'];
				
				if ($this->User->save($user)) {
						$this->Session->setFlash(__('Thông tin tải khoản đã được cấp lại. Vui lòng kiểm tra email của thành viên.', true));
						
						
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = 'info@muanhaonline.com.vn';
						$this->SwiftMailer->fromName = 'MuaNhaOnline.com.vn';
						$this->SwiftMailer->to = $user["User"]["email"];
						//set variables to template as usual
						$this->set('rand_password', $rand_password);
						$this->set('user', $user);
						//$this->set('prod', $product);
						
						try {
						    if(!$this->SwiftMailer->send('forget_password', "Thông tin tài khoản thành viên")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
						
						
						$this->redirect(array('controller'=>'users', 'action' => 'login'));
				} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
				}
						
				//$this->Session->setFlash(__('thang cong', true));
				//$this->redirect(array('controller'=>'products', 'action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('Thông tin tài khoản không đúng. Xin thử lại', true));				
			}
	}
	$this->set('groups', $this->User->Group->find('list'));
    }
    
    public function add() {
      if (!empty($this->data)) {
	$this->data['User']['confirm_password'] = $this->data['User']['password'];
        $this->User->create();
        if ($this->User->save($this->data)) {
		
          $this->Session->setFlash('User created!');
          $this->redirect(array('action'=>'login'));
        } else {
          $this->Session->setFlash('Please correct the errors');
        }
      }
      $this->set('groups', $this->User->Group->find('list'));
    }
    
    public function login() {
	$this->layout = 'home';
	
	if(isset($this->params['form']['ajax'])) {
		$this->layout = null;
		$this->autoRender = false;
	}	
	
	$user = $this->Auth->user();
	
	$this->set('user', $user);
	
	if($user) {
		if(!isset($this->params['form']['ajax'])) {
			if(isset($this->params['form']['redirect']))
			{
				$type = $this->params['form']['redirect'];
				
				switch($type) {
					case 'need':
						$this->redirect(array(
								      'admin' => false,
								      'controller'=>'needs',
								      'action'=>'guest_add'
							)
						);
						break;
					case 'fixprice':
						$this->redirect(array(
								      'admin' => false,
								      'controller'=>'fixprice_orders',
								      'action'=>'add_step1'
							)
						);
					case 'product':
						$this->redirect(array(
								      'controller'=>'products',
								      'action'=>'add',
								      'manager'=>true
							)
						);
						break;
				}			
			}
			else
			{
				$this->redirect(array('admin' => false,
					'controller' => 'users',
					'action' => 'dashboard')
				);
			}
		}
		else {
			if(isset($this->params['form']['redirect']))
			{
				$type = $this->params['form']['redirect'];
				
				switch($type) {
					case 'need':
						echo Router::url(array(
								      'admin' => false,
								      'controller'=>'needs',
								      'action'=>'guest_add'
							));						
						break;
					case 'fixprice':
						echo Router::url(array(
								      'admin' => false,
								      'controller'=>'fixprice_orders',
								      'action'=>'add_step1'
							)
						);
					case 'product':
						echo Router::url(array(
								      'controller'=>'products',
								      'action'=>'add',
								      'manager'=>true
							)
						);
						break;
					default:
						echo "reload";
						break;
				}
			}
		}
	}
	else
	{
		if(isset($this->params['form']['ajax'])) {
			echo 0;
		}
	}	
    }
    
    public function admin_login() {
        $this->redirect(array('action'=>'login'));
    }
    
    public function manager_login() {
        $this->redirect(array('action'=>'login', 'manager'=>false));
    }
    
    public function expert_login() {
        $this->redirect(array('action'=>'login', 'expert'=>false));
    }
    
    public function supervisor_login() {
        $this->redirect(array('action'=>'login', 'supervisor'=>false));
    }
    
    public function inspector_login() {
        $this->redirect(array('action'=>'login', 'inspector'=>false));
    }
    
    public function logout() {
        $user = $this->Auth->user();
        Controller::loadModel('Group');
        
        if (!empty($user)) {
          $user = $user[$this->Auth->getModel()->alias];
          $group = $this->Group->find('first', array('conditions' => array('Group.id'=>$this->Auth->user('group_id'))));
          $pf = $this->User->UserProfile->find('first', array('conditions' => array('UserProfile.user_id'=>$user["id"])));
          $user["Group"] = $group["Group"];
          $user["UserProfile"] = $pf["UserProfile"];
        }
        
        if($user["Group"]["id"] == 3)
        {
            $this->Auth->logout();
            $this->redirect(array('controller'=>'home', 'action' => 'index'));
        }

        $this->Auth->logout();
	$this->redirect(array('controller'=>'home', 'action' => 'index'));
    }
    public function dashboard() {
        $user = $this->Auth->user();
        if(empty($user))
        {
            $this->redirect(array('action'=>'login'));
        }
        $groupName = $this->User->Group->field('name',
          array('Group.id'=>$this->Auth->user('group_id'))
        );
        $this->redirect(array('action'=>strtolower($groupName)));
    }
    public function user() {
        $this->redirect(array('controller'=>'home', 'action' => 'index'));
    }
    
    public function expert() {
        $this->redirect(array('controller'=>'fixprice_orders', 'action' => 'index', 'expert'=>true));
    }
    
    
    public function manager() {
	if($this->Session->read("new_register") == "1")
	{
		$this->redirect(array('controller'=>'products', 'action' => 'add', 'manager'=>true));
	}
	else
	{
		$this->redirect(array('controller'=>'products', 'action' => 'index', 'manager'=>true));
	}
    }
    
    public function supervisor() {
	//echo "fgdgd";
	$this->redirect(array('controller'=>'fixprice_orders', 'action' => 'index', 'supervisor'=>true));
    }
    
    public function inspector() {
	//echo "fgdgd";
	$this->redirect(array('controller'=>'fixprice_orders', 'action' => 'index', 'inspector'=>true));
    }
    
    public function administrator() {
        $this->redirect(array('controller'=>'products', 'action' => 'index', 'admin'=>true));
    }
    
    function getUser()
    {
        $user = $this->Auth->user();
        Controller::loadModel('Group');
        
        if (!empty($user)) {
          $user = $user[$this->Auth->getModel()->alias];
          $group = $this->Group->find('first', array('conditions' => array('Group.id'=>$this->Auth->user('group_id'))));
          $pf = $this->User->UserProfile->find('first', array('conditions' => array('UserProfile.user_id'=>$user["id"])));
          $user["Group"] = $group["Group"];
          $user["UserProfile"] = $pf["UserProfile"];
	  $user["UserImage"] = $pf["UserImage"];
        }
        else
        {
            return 0;
        }
        
        //$this->set(compact('user'));
        //$this->set(compact('group'));
        return $user;
    }
    
    function whoisonline(){

                $sessiondata = $this->User->query('SELECT `data` FROM `hk_cake_sessions`');
                //pr($sessiondata);
                $count["guest"] = 0;
                $count["user"] = 0;
		$onlineusers = array();
                foreach($sessiondata as $sess){
                        $count["guest"]++;
                        $sessdata = preg_replace('/[0-9]{1,3}:/','',$sess['hk_cake_sessions']['data']);
                        $sessarray = explode(';s:',$sessdata);

                        //var_dump($sessarray);

                        foreach ($sessarray as $key =>$wert){
                            //echo $wert."-".$key;
                                if ($wert == '"username"') {
                                    //echo "d3434dfgdfgdgdfgd";
                                        $count["user"]++;
                                        $count["guest"]--;
                                        break;
                                        
                                }                                
                        }
                        $key++;
                        //echo "000000000000".$key."00000000000000";
                        if(isset($sessarray[$key]))
                        {
                            $name =  $sessarray[$key];
                            //echo $name;
                            $name = preg_replace('/"/','',$name);
                            $onlineusers[]=$name;
                        }
                        
                }
                //pr($onlineuser);                
                $result["onlineusers"] = $onlineusers;
                $result["count"] = $count;
                return $result;
        }
	
	function onlines()
	{
		$current = 76681;
		
		$guests = $this->User->Online->find('all', array('conditions'=>array('Online.user_id'=>0, 'Online.offline'=>0)));
		$users = $this->User->Online->find('all', array('conditions'=>array('Online.user_id !='=>0, 'Online.offline'=>0)));
		$total = $this->User->Online->find('count');
		$count["guest"] = count($guests);
		$count["user"] = count($users);
		$count["total"] = $total + $current;
		
		return $count;
	}
	
	function autoOnline()
	{
		$this->layout = null;
		parent::online_render();
		return;
	}
	
	/**
	 * Creates object of Captcha Component class  
	 *
	 * @return void
	 * @access protected
	 */
	
	function create_captcha()	{
			App::import("Component","Captcha"); //including captcha class
			$this->Captcha =  new CaptchaComponent(); //creating an object instance
			$this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
			$this->set('captcha_src',$captcha_src=$this->Captcha->create()); //create a capthca and assign to a variable
	}

	/**
	 * Process the form to check user has entered a valid captcha code  
	 *
	 * @return void
	 * @access public
	 */

	function captcha_test()	{		
		if(!empty($this->data))	{ //if form is submitted
			if($this->data['User']['ver_code']==$this->Session->read('ver_code'))	{ //comparing both codes
				$this->flash(__("Captcha verification success",true),"captcha_test"); //user has entered a valid verification code
			}	else	{
				$this->flash(__("Captcha verification failure",true),"captcha_test"); //invalid code
			}
		}
		$this->create_captcha(); //not form action performed, create a captch code and show the form
		$this->render();
	}
	
	function getExpertSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                $count["fixprice_order_new"] = count($this->FixpriceOrder->getByState('PAID'));
		$count["fixprice_order_private_register"] = count($this->FixpriceOrder->getByState('PRIVATE_REGISTER'));
		$count["fixprice_order_registered"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'REGISTERED'));
		
		$count["fixprice_order_assigned"] = count($this->FixpriceOrder->getByAssigner($user['User']['id'], 'EXPERT_CONFIRMED'));
		$count["fixprice_order_assigned_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'ASSIGNED'));
		$count["fixprice_order_expert_pending"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'EXPERT_PENDING'));
		$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], array('VALID','INSPECTOR_CONFIRMED_PENDING_ERROR')));
		$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'INVALID'));
		$count["fixprice_order_rated"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'FINISHED_RATED'));
		$count["fixprice_order_failed"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], array('INSPECTOR_CONFIRMED', 'PUBNISHED', 'FAILED')));
		
		$count["fixprice_order_confirmed"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'EXPERT_CONFIRMED'));
		$count["fixprice_order_rejected"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'EXPERT_REJECTED'));
		
		$count["fixprice_order_confirmed_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'EXPERT_CONFIRMED'));
		$count["fixprice_order_rejected_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'EXPERT_REJECTED'));
		
		$count['isLeader'] = $this->FixpriceOrder->isLeader($user['User']['id']);
		
		
		$count["fixprice_order_working"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], array('EXPERT_CONFIRMED','EXPERT_PENDING','INVALID')));
		$count["fixprice_order_finished_all"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], array('FINISHED_RATED','VALID')));
		
		$count["fixprice_order_working_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], array('EXPERT_CONFIRMED','EXPERT_PENDING','INVALID')));
		$count["fixprice_order_finished_all_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], array('FINISHED_RATED','VALID')));
		$count["fixprice_order_invalid_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'INVALID'));
		$count["fixprice_order_failed_lead"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], array('INSPECTOR_CONFIRMED', 'PUBNISHED', 'FAILED')));
		//$count["fixprice_order_notpaid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'1', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
		//$count["fixprice_order_pending"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'4', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
		//$count["fixprice_order_valid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'5', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
		//$count["fixprice_order_invalid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'-1', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
                
		return $count;
	}
	
	function getUserFixpriceSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                //$count["fixprice_order_new"] = count($this->FixpriceOrder->getByState('PAID'));
		//$count["fixprice_order_private_register"] = count($this->FixpriceOrder->getByState('PRIVATE_REGISTER'));
		//$count["fixprice_order_registered"] = count($this->FixpriceOrder->getByGroupLeader($user['User']['id'], 'REGISTERED'));
		//$count["fixprice_order_assigned"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'ASSIGNED'));
		//$count["fixprice_order_expert_pending"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'EXPERT_PENDING'));
		//$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'VALID'));
		//$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByExpert($user['User']['id'], 'INVALID'));
		
		//$count['isLeader'] = $this->FixpriceOrder->isLeader($user['User']['id']);
		
		
		$count["fixprice_order_notpaid"] = count($this->FixpriceOrder->getByUser('NEW_PRODUCT', $user['User']['id']));
		$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByUser(array('VALID', 'PUBLISHED'), $user['User']['id']));
		//echo $count["fixprice_order_valid"];
		//var_dump($this->FixpriceOrder->getByState('NEW_PRODUCT'));
		$count["fixprice_order_pending"] = count($this->FixpriceOrder->getByUser(array('PAID', 'REGISTERED', ' PRIVATE_REGISTER', 'ASSIGNED', 'EXPERT_PENDING', 'INVALID'), $user['User']['id']));
		$count["fixprice_order_rated"] = count($this->FixpriceOrder->getByUser('FINISHED_RATED', $user['User']['id']));
		//$count["fixprice_order_valid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'5', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
		//$count["fixprice_order_invalid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'-1', 'FixpriceOrder.expert_id'=>$user['User']['id'])));
                
		return $count;
	}
	
	function getFixpriceSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                $count["fixprice_order_new"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'2', 'FixpriceOrder.user_id'=>$user['User']['id'])));
		$count["fixprice_order_notpaid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'1', 'FixpriceOrder.user_id'=>$user['User']['id'])));                
                
		return $count;
	}
	
	function getAdminFixpriceSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                $count["fixprice_order_new"] = count($this->FixpriceOrder->getByState('PAID'));
		$count["fixprice_order_private_register"] = count($this->FixpriceOrder->getByState('PRIVATE_REGISTER'));
		$count["fixprice_order_registered"] = count($this->FixpriceOrder->getByState('REGISTERED'));
		$count["fixprice_order_assigned"] = count($this->FixpriceOrder->getByState('ASSIGNED'));
		$count["fixprice_order_expert_pending"] = count($this->FixpriceOrder->getByState('EXPERT_PENDING'));
		$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByState('VALID'));
		$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByState('INVALID'));
		
		
		$count["fixprice_order_notpaid"] = count($this->FixpriceOrder->getByState('NEW_PRODUCT'));
		//$count["fixprice_order_assigned"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'3')));
		//$count["fixprice_order_pending"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'4')));
		//$count["fixprice_order_invalid"] = $this->FixpriceOrder->find('count', array('conditions'=>array('FixpriceOrder.status'=>'-1')));
                
		return $count;
	}
	
	function getSupervisorFixpriceSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                $count["fixprice_order_new"] = count($this->FixpriceOrder->getByState('PAID'));
		$count["fixprice_order_private_register"] = count($this->FixpriceOrder->getByState('PRIVATE_REGISTER'));
		$count["fixprice_order_registered"] = count($this->FixpriceOrder->getByState('REGISTERED'));
		$count["fixprice_order_assigned"] = count($this->FixpriceOrder->getByState('ASSIGNED'));
		$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByState('INVALID'));
		$count["fixprice_order_rated"] = count($this->FixpriceOrder->getByState('FINISHED_RATED'));
		$count["fixprice_order_expert_pending"] = count($this->FixpriceOrder->getByState('EXPERT_PENDING'));
		$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByState('VALID'));
		$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByState('INVALID'));
		$count["fixprice_order_rated"] = count($this->FixpriceOrder->getByState('FINISHED_RATED'));
		
		$count["fixprice_order_confirmed"] = count($this->FixpriceOrder->getByState('EXPERT_CONFIRMED'));
		$count["fixprice_order_rejected"] = count($this->FixpriceOrder->getByState('EXPERT_REJECTED'));
		
		
		$count["fixprice_order_notpaid"] = count($this->FixpriceOrder->getByState('NEW_PRODUCT'));
		
		//echo $count["fixprice_order_expert_pending"];
		
		return $count;
	}
	
	function getInspectorFixpriceSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
		Controller::loadModel('FixpriceOrder');
		
                $count["fixprice_order_new"] = count($this->FixpriceOrder->getByState('PAID'));
		$count["fixprice_order_private_register"] = count($this->FixpriceOrder->getByState('PRIVATE_REGISTER'));
		$count["fixprice_order_registered"] = count($this->FixpriceOrder->getByState('REGISTERED'));
		$count["fixprice_order_assigned"] = count($this->FixpriceOrder->getByState('ASSIGNED'));
		$count["fixprice_order_expert_pending"] = count($this->FixpriceOrder->getByState('EXPERT_PENDING'));
		$count["fixprice_order_valid"] = count($this->FixpriceOrder->getByState('VALID'));
		$count["fixprice_order_invalid"] = count($this->FixpriceOrder->getByState('INVALID'));
		$count["fixprice_order_rated"] = count($this->FixpriceOrder->getByState('FINISHED_RATED'));
		$count["fixprice_order_inspector_confirmed"] = count($this->FixpriceOrder->getByState(array('INSPECTOR_CONFIRMED','INSPECTOR_CONFIRMED_PENDING_ERROR')));
		$count["fixprice_order_inspector_confirm_wait"] = count($this->FixpriceOrder->getByState('INSPECTOR_CONFIRM_WAIT'));
		
		
		$count["fixprice_order_notpaid"] = count($this->FixpriceOrder->getByState('NEW_PRODUCT'));
		
		//echo $count["fixprice_order_expert_pending"];
		
		return $count;
	}
	
	function testmail()
	{
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = 'luanpm@live.com';
						
						//Create Order link						
						//$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"]), false);
						
						//$this->set('fixprice_order', $fixprice_order);
						//$this->set('checkout_link', $checkout_link);
						//$this->set('order_link', $order_link);
						
						//get mail content
						//$mail_content = $this->Content->read(null, 907);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						//$this->set('mail_content', $mail_content);
						
						
						try {
						    if(!$this->SwiftMailer->send('test_mail', 'welcome')) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
	}
	
	function getNotifications()
	{
		$user = $this->Auth->user();
		
		Controller::loadModel('FixpriceOrder');
		Controller::loadModel('User');
		
		$udb = new User();
		
		$user = $udb->read(null, $user['User']['id']);
		
		if($user['Group']['id'] == 6)
		{
			return count($this->FixpriceOrder->getByState('EXPERT_PENDING'));
		}
		else if($user['Group']['id'] == 4)
		{
			return count($this->FixpriceOrder->getByExpert($user['User']['id'], array('ASSIGNED', 'INVALID')));
		}
	}
	
	
}
