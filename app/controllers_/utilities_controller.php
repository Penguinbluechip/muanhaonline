<?php
class UtilitiesController extends AppController {

	var $name = 'Utilities';
	
	public function beforeFilter() {
		$this->Auth->allow('ajaxUtilityList', 'getAll');
	}


	function admin_index() {
		$this->Utility->recursive = 0;
		$this->set('utilities', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid utility', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('utility', $this->Utility->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Utility->create();
			if ($this->Utility->save($this->data)) {
				$this->Session->setFlash(__('The utility has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The utility could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid utility', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Utility->save($this->data)) {
				$this->Session->setFlash(__('The utility has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The utility could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Utility->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for utility', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Utility->delete($id)) {
			$this->Session->setFlash(__('Utility deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Utility was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajaxUtilityList($cat_id)
	{
		Controller::loadModel('Category');
		//echo $city_id;
		$cat = $this->Category->read(null, $cat_id);
		//echo count($districts);
		$this->set(compact('cat'));
		$this->layout = null;
	}
}
