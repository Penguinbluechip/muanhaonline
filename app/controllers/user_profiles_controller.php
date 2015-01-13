<?php
class UserProfilesController extends AppController {

	var $name = 'UserProfiles';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add_profile', 'index');
	}

	function admin_index() {
		$this->UserProfile->recursive = 0;
		$this->set('userProfiles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user profile', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userProfile', $this->UserProfile->read(null, $id));
	}

	function admin_add($sid = null) {		
		if (!empty($this->data)) {
			$this->UserProfile->create();
			if ($this->UserProfile->save($this->data)) {
				$this->Session->setFlash(__('The user profile has been saved', true));
				
				//var_dump($this->data["UserImage"]);
				$this->data["UserImage"]["user_profile_id"] = $this->UserProfile->id;
				$this->UserProfile->UserImage->create();
				if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				
				$this->redirect(array('controller'=>'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserProfile->User->find('list');
		$this->set(compact('users', 'sid'));
	}
	
	function add_profile() {
		$this->layout = 'home';
		
		$sid = $this->Session->read("new_user_id");
		if(!$this->Session->read("new_user_id"))
		{
			$this->Session->setFlash(__('Người dùng không xác thực', true));
			$this->redirect(array('controller'=>'home', 'action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->data["UserProfile"]["user_id"] = $sid;
			
			$this->UserProfile->create();
			if ($this->UserProfile->save($this->data)) {
				$this->Session->setFlash(__('The user profile has been saved', true));
				
				//var_dump($this->data["UserImage"]);
				$this->data["UserImage"]["user_profile_id"] = $this->UserProfile->id;
				$this->UserProfile->UserImage->create();
				if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				$this->Session->write("new_user_id", 0);
				$this->Session->setFlash(__('Thông tin tài khoản đã được lưu thành công.', true));
				$this->redirect(array('controller'=>'user_profiles', 'action' => 'edit_profile'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserProfile->User->find('list');
		$companies = $this->UserProfile->Company->find('list', array('conditions'=>array('Company.company_category_id'=>10)));
		$this->set(compact('users', 'companies'));
	}
	
	function edit_profile() {
		$this->layout = 'home';
		
		$user = $this->Auth->user();
		//var_dump($user);
		
		if (!empty($user))
		{
			$pf = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
			//var_dump($pf);
			if (!empty($this->data)) {
				$this->data["UserProfile"]["user_id"] = $user["User"]["id"];
				
				$this->data["UserProfile"]["id"] = $pf["UserProfile"]["id"];
				
				//$this->UserProfile->create();
				if ($this->UserProfile->save($this->data)) {
					$this->Session->setFlash(__('The user profile has been saved', true));
					
					
					if($this->data["UserImage"]["filename"]["name"] != "")
					{
						//$profile = $this->UserProfile->read(null, $id);
						$this->UserProfile->UserImage->delete($pf["UserImage"]["id"]);
					}
					
					//var_dump($this->data["UserImage"]);
					$this->data["UserImage"]["user_profile_id"] = $this->UserProfile->id;
					$this->UserProfile->UserImage->create();
					if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
						$this->Session->setFlash(__('The Image has been saved', true));
								//$this->redirect(array('action' => 'index'));
					} else {
								//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
					}
					
					$this->Session->write("new_user_id", 0);
					$this->Session->setFlash(__('Thông tin tài khoản đã được lưu thành công.', true));
					$this->redirect(array('controller'=>'user_profiles', 'action' => 'edit_profile'));
				} else {
					$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->UserProfile->read(null, $pf["UserProfile"]["id"]);
			}
		}
		else
		{
			$this->Session->setFlash(__('Người dùng không đúng', true));
			$this->redirect(array('controller'=>'home','action' => 'index'));
		}
		$users = $this->UserProfile->User->find('list');
		$companies = $this->UserProfile->Company->find('list', array('conditions'=>array('Company.company_category_id'=>10)));
		$this->set(compact('users', 'companies'));
	}
	
	function manager_editprofile() {
	
		$user = $this->Auth->user();
		//var_dump($user);
		
		if (!empty($user))
		{
			$pf = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
			//var_dump($pf);
			if (!empty($this->data)) {
				$this->data["UserProfile"]["user_id"] = $user["User"]["id"];
				
				$this->data["UserProfile"]["id"] = $pf["UserProfile"]["id"];
				
				//$this->UserProfile->create();
				if ($this->UserProfile->save($this->data)) {
					$this->Session->setFlash(__('The user profile has been saved', true));
					
					
					if($this->data["UserImage"]["filename"]["name"] != "")
					{
						//$profile = $this->UserProfile->read(null, $id);
						$this->UserProfile->UserImage->delete($pf["UserImage"]["id"]);
					}
					
					//var_dump($this->data["UserImage"]);
					$this->data["UserImage"]["user_profile_id"] = $this->UserProfile->id;
					$this->UserProfile->UserImage->create();
					if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
						$this->Session->setFlash(__('The Image has been saved', true));
								//$this->redirect(array('action' => 'index'));
					} else {
								//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
					}
					
					$this->Session->write("new_user_id", 0);
					$this->Session->setFlash(__('Thông tin tài khoản đã được lưu thành công.', true));
					$this->redirect(array('controller'=>'products', 'action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->UserProfile->read(null, $pf["UserProfile"]["id"]);
			}
		}
		else
		{
			$this->Session->setFlash(__('Người dùng không đúng', true));
			$this->redirect(array('controller'=>'products','action' => 'index'));
		}
		
		//count bds
		Controller::loadModel('Product');
		//count bds
		
		$users = $this->UserProfile->User->find('list');
		$companies = $this->UserProfile->Company->find('list', array('conditions'=>array('Company.company_category_id'=>10)));
		$this->set(compact('users', 'companies'));
	}

	function admin_edit($id = null, $user_id = null) {
		if (!$id && empty($this->data)) {
			if ($user_id != null) {
				$this->redirect(array('action' => 'add'));				
			}
			$this->Session->setFlash(__('Invalid user profile', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserProfile->save($this->data)) {
				$this->Session->setFlash(__('The user profile has been saved', true));
								
				if($this->data["UserImage"]["filename"]["name"] != "")
				{
					$profile = $this->UserProfile->read(null, $id);
					$this->UserProfile->UserImage->delete($profile["UserImage"]["id"]);
				}
				
				$this->data["UserImage"]["user_profile_id"] = $id;
				$this->UserProfile->UserImage->create();
				if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				
				$this->redirect(array('controller'=>'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserProfile->read(null, $id);
		}
		$users = $this->UserProfile->User->find('list');
		//$companies = $this->UserProfile->Company->find('list', array('conditions'=>array('Company.company_category_id'=>10)));
		$this->set(compact('users', 'companies'));
	}
	
	function user_edit($id = null, $user_id = null) {
		if (!$id && empty($this->data)) {
			if ($user_id != null) {
				$this->redirect(array('action' => 'add'));				
			}
			$this->Session->setFlash(__('Invalid user profile', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserProfile->save($this->data)) {
				$this->Session->setFlash(__('The user profile has been saved', true));
								
				if($this->data["UserImage"]["filename"]["name"] != "")
				{
					$profile = $this->UserProfile->read(null, $id);
					$this->UserProfile->UserImage->delete($profile["UserImage"]["id"]);
				}
				
				$this->data["UserImage"]["user_profile_id"] = $id;
				$this->UserProfile->UserImage->create();
				if ($this->UserProfile->UserImage->save($this->data["UserImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				
				$this->redirect(array('controller'=>'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserProfile->read(null, $id);
		}
		$users = $this->UserProfile->User->find('list');
		$companies = $this->UserProfile->Company->find('list', array('conditions'=>array('Company.company_category_id'=>10)));
		$this->set(compact('users', 'companies'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user profile', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserProfile->delete($id)) {
			$this->Session->setFlash(__('User profile deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User profile was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
