<?php
class CustomersController extends AppController {

	var $name = 'Customers';
	var $components = array('SwiftMailer'); 
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('contact');
        }
	
	function contact()
	{
		$this->layout = "home";
		Controller::loadModel('Type');
		
		////Captcha
		//App::import('Vendor', 'recaptcha', array('file' => 'recaptchalib.php'));
		//$privatekey = "6LckqMkSAAAAACd8qyHu0GlzRFN1SiRYMv-jagL9";
		//$resp = recaptcha_check_answer($privatekey,
		//			      $_SERVER["REMOTE_ADDR"],
		//			      $_POST["recaptcha_challenge_field"],
		//			      $_POST["recaptcha_response_field"]);
	      
		
		
		
		if (!empty($this->data)) {
			if($this->data["Customer"]["product_id"] && $this->data["Customer"]["user_id"])
			{
				$product = $this->Customer->Product->find('first', array('conditions'=>array('Product.id'=>$this->data["Customer"]["product_id"])));
				$user = $this->Customer->User->find('first', array('conditions'=>array('User.id'=>$this->data["Customer"]["user_id"])));
				
				
				if (true) {		   
		
					$this->Customer->create();
					if ($this->Customer->save($this->data)) {
						
						
						
						
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = $this->data["Customer"]["email"];
						$this->SwiftMailer->fromName = $this->data["Customer"]["name"];
						$this->SwiftMailer->to = $user["User"]["email"];
						//set variables to template as usual
						$this->set('message', $this->data["Customer"]["message"]);
						$this->set('customer', $this->data);
						$this->set('prod', $product);
						
						try {
						    if(!$this->SwiftMailer->send('contact_expert', "Liên hệ với chuyên viên")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
						
						$this->Session->setFlash(__('Cám ơn bạn đã liên hệ với chúng tôi.', true));
						
						$this->redirect(array('controller'=>'products', 'action'=>'details',
									'city'=>strtolower(Inflector::slug($product["City"]["name"])),
									'id'=>$product["Product"]["id"],
									'name'=>strtolower(Inflector::slug($product["Product"]["name"]))));
					} else {
						$this->Session->setFlash(__('Không thể thực hiện yêu cầu. Vui lòng điền đầy đủ thông tin bên dưới.', true));
					}
				}
				else
				{
					 $this->Session->setFlash('Mã bảo mật không chính xác');
				}
			}
			
		}
		else
		{
			$this->redirect(array('controller'=>'products', 'action' => 'index'));
		}
		$users = $this->Customer->User->find('list');
		$products = $this->Customer->Product->find('list');
		$types = $this->Type->find('all');
		
		$this->set(compact('users', 'products', 'types', 'product'));
		$this->set('usr', $user);
	}

	function admin_index() {
		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customer', $this->Customer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Customer->create();
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Customer->User->find('list');
		$products = $this->Customer->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Customer->read(null, $id);
		}
		$users = $this->Customer->User->find('list');
		$products = $this->Customer->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for customer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Customer->delete($id)) {
			$this->Session->setFlash(__('Customer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_index() {
		$this->Customer->recursive = 0;
		$user = $this->Auth->user();
		
		$this->paginate = array('conditions'=>array('Customer.user_id'=>$user["User"]["id"]));		
		$this->set('customers', $this->paginate());
	}

	function manager_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customer', $this->Customer->read(null, $id));
	}

	function manager_add() {
		if (!empty($this->data)) {
			$this->Customer->create();
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Customer->User->find('list');
		$products = $this->Customer->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Customer->User->isUserCustomer($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				
			}
		
		if (!empty($this->data)) {
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Customer->read(null, $id);
		}
		$users = $this->Customer->User->find('list');
		$products = $this->Customer->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for customer', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Customer->User->isUserCustomer($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				
			}
		
		if ($this->Customer->delete($id)) {
			$this->Session->setFlash(__('Customer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
