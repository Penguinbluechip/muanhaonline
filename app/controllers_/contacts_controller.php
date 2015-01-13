<?php
class ContactsController extends AppController {

	var $name = 'Contacts';
	var $components = array('SwiftMailer'); 
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('view', 'mail', 'snippet');
        }
	
	function view($id = null)
	{
		$sucess = "";
		$error = "";
		if (!empty($this->data)) {
			if($this->data["email"] != "" && $this->data["name"] != "")
			{
				//var_dump($this->data);
				$this->layout = 'home';
				$this->SwiftMailer->smtpType = 'tls';
				$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
				$this->SwiftMailer->smtpPort = 587;
				$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
				$this->SwiftMailer->smtpPassword = 'bdsonline$';
			
				$this->SwiftMailer->sendAs = 'html';
				$this->SwiftMailer->from = $this->data["email"];
				$this->SwiftMailer->fromName = $this->data["name"];
				$this->SwiftMailer->to = 'minhluaniq@gmail.com';
				//set variables to template as usual
				$this->set('message', $this->data["message"]);
				
				try {
				    if(!$this->SwiftMailer->send('im_excited', $this->data["subject"])) {
					$this->log("Error sending email");
					echo "Error sending email";
				    }
				}
				catch(Exception $e) {
				      $this->log("Failed to send email: ".$e->getMessage());
				      $error = "failed".$e->getMessage();
				}
				//$this->redirect($this->referer(), null, true);
				$sucess = __('Cám ơn đã liên hệ với chúng tôi.', true);
			}
			else
			{
				$this->Session->setFlash(__('Điền vào các nội dung được yêu cầu.', true));
				$error = __('Điền vào các nội dung được yêu cầu.', true);
			}
		}
		
		//mail();
		
		$this->layout = 'home';
		Controller::loadModel('Content');
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid contact', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$slogan = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'3'
							)
						)
				);
		
		$letter = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'7'
							)
						)
					);
		
		
		$this->set('contact', $this->Contact->read(null, $id));
		$this->set('slogan', $slogan);
		$this->set('error', $error);
		$this->set('sucess', $sucess);
		$this->set('letter', $letter);
	}
	
	public function mail() {
		
		$this->layout = 'home';
		$this->SwiftMailer->smtpType = 'tls';
		$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
		$this->SwiftMailer->smtpPort = 465;
		$this->SwiftMailer->smtpUsername = 'minhluan@hoangkhang.com.vn';
		$this->SwiftMailer->smtpPassword = 'gauheo';
	
		$this->SwiftMailer->sendAs = 'html';
		$this->SwiftMailer->from = 'noone@x.com';
		$this->SwiftMailer->fromName = 'New bakery component';
		$this->SwiftMailer->to = 'minhluaniq@gmail.com';
		//set variables to template as usual
		$this->set('message', 'My message');
		
		try {
		    if(!$this->SwiftMailer->send('im_excited', 'My subject')) {
			$this->log("Error sending email");
		    }
		}
		catch(Exception $e) {
		      $this->log("Failed to send email: ".$e->getMessage());
		}
		$this->redirect($this->referer(), null, true);
	}
	
	

	function admin_index() {
		$this->Contact->recursive = 0;
		$this->set('contacts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contact', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('contact', $this->Contact->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Contact->create();
			if ($this->Contact->save($this->data)) {
				$this->Session->setFlash(__('The contact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid contact', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Contact->save($this->data)) {
				$this->Session->setFlash(__('The contact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Contact->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contact', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Contact->delete($id)) {
			$this->Session->setFlash(__('Contact deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contact was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
