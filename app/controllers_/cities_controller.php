<?php
class CitiesController extends AppController {

	var $name = 'Cities';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('getCurrentCity', 'getAll');
        }

	function admin_index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid city', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('city', $this->City->read(null, $id));
	}
	
	function getCurrentCity($id = null) {
		if($this->Session->read("filter_city_id"))
			return $this->City->read(null, $this->Session->read("filter_city_id"));
		else
			return 0;
	}
	
	function getAll($id = null) {
		return $this->City->find('all', array('order'=>'City.name'));		
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->City->create();
			if ($this->City->save($this->data)) {
				$this->Session->setFlash(__('The city has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid city', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->City->save($this->data)) {
				$this->Session->setFlash(__('The city has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->City->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for city', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->City->delete($id)) {
			$this->Session->setFlash(__('City deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('City was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
