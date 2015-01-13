<?php
class ExpertGroupsController extends AppController {

	var $name = 'ExpertGroups';

	function admin_index() {
		$this->ExpertGroup->recursive = 0;
		$this->set('expertGroups', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('expertGroup', $this->ExpertGroup->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ExpertGroup->create();
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('The expert group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expert group could not be saved. Please, try again.', true));
			}
		}
		
		Controller::loadModel('City');
		//Controller::loadModel('User');
		
		//$user = $this->User->read(null, 1);
		//$user->getExpertGroups();
		//var_dump($user);
		
		$default_city_id = 1;
		$this->data['ExpertGroup']['city_id'] = $default_city_id;
		$cities = $this->City->find('list');
		$districts = $this->ExpertGroup->District->find('list', array('conditions'=>array('District.city_id'=>$default_city_id)));		
		
		$users = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.group_id'=>'4')));
		$this->set(compact('districts', 'users', 'cities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('The expert group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expert group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExpertGroup->read(null, $id);			
		}
		
		//var_dump($this->data);
		
		Controller::loadModel('City');
		
		$default_city_id = 1;
		$this->data['ExpertGroup']['city_id'] = $default_city_id;
		$cities = $this->City->find('list');
		$districts = $this->ExpertGroup->District->find('list', array('conditions'=>array('District.city_id'=>$default_city_id)));		
		$users = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.group_id'=>'4')));
		$this->set(compact('districts', 'users', 'cities'));
	}
	
	function admin_addleader($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('The group\'s leader has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group\'s leader could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExpertGroup->read(null, $id);			
		}
		
		$expert_array = array();		
		foreach($this->data["User"] as $u)
		{
			$expert_array[] = $u["id"];
		}
		
		
		$experts = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.id'=>$expert_array)));
		//array_unshift($experts, array("0"=>"-- chọn --"));
		//var_dump($experts);
		$this->set(compact('experts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for expert group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ExpertGroup->delete($id)) {
			$this->Session->setFlash(__('Expert group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Expert group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function supervisor_index() {
		$this->ExpertGroup->recursive = 0;
		$this->set('expertGroups', $this->paginate());
	}

	function supervisor_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('expertGroup', $this->ExpertGroup->read(null, $id));
	}

	function supervisor_add() {
		if (!empty($this->data)) {
			$this->ExpertGroup->create();
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('Nhóm đã được lưu', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expert group could not be saved. Please, try again.', true));
			}
		}
		
		Controller::loadModel('City');
		Controller::loadModel('FixpriceOrder');
		//Controller::loadModel('User');
		
		//$user = $this->User->read(null, 1);
		//$user->getExpertGroups();
		//var_dump($user);
		
		$default_city_id = 1;
		$this->data['ExpertGroup']['city_id'] = $default_city_id;
		$cities = $this->City->find('list');
		$districts = $this->ExpertGroup->District->find('list', array('conditions'=>array('District.city_id'=>$default_city_id)));		
		
		$users = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.group_id'=>'4')));
		
		//remove leader
		foreach($users as $key => $user)
		{
			if($this->FixpriceOrder->isLeader($key))
			{
				unset($users[$key]);
			}
		}
		
		$this->set(compact('districts', 'users', 'cities'));
	}

	function supervisor_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('Nhóm đã được lưu', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expert group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExpertGroup->read(null, $id);			
		}
		
		//var_dump($this->data);
		
		Controller::loadModel('City');
		Controller::loadModel('FixpriceOrder');
		
		$default_city_id = 1;
		$this->data['ExpertGroup']['city_id'] = $default_city_id;
		$cities = $this->City->find('list');
		$districts = $this->ExpertGroup->District->find('list', array('conditions'=>array('District.city_id'=>$default_city_id)));		
		$users = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.group_id'=>'4')));
		//remove leader
		foreach($users as $key => $user)
		{
			if($this->FixpriceOrder->isLeader($key))
			{
				unset($users[$key]);
			}
		}
		
		
		$this->set(compact('districts', 'users', 'cities'));
	}
	
	function supervisor_addleader($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid expert group', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->ExpertGroup->save($this->data)) {
				$this->Session->setFlash(__('Trưởng nhóm đã được thay đổi', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group\'s leader could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExpertGroup->read(null, $id);			
		}
		
		$expert_array = array();		
		foreach($this->data["User"] as $u)
		{
			$expert_array[] = $u["id"];
		}
		
		//var_dump($expert_array);
		
		$experts = $this->ExpertGroup->User->find('list', array('conditions'=>array('User.id'=>$expert_array)));

		$this->set(compact('experts'));
	}

	function supervisor_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for expert group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ExpertGroup->delete($id)) {
			$this->Session->setFlash(__('Đã xóa', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Expert group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
