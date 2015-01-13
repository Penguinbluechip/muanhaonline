<?php
class NeedTypesController extends AppController {

	var $name = 'NeedTypes';

	function admin_index() {
		$this->NeedType->recursive = 0;
		$this->set('needTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid need type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('needType', $this->NeedType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->NeedType->create();
			if ($this->NeedType->save($this->data)) {
				$this->Session->setFlash(__('The need type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The need type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid need type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NeedType->save($this->data)) {
				$this->Session->setFlash(__('The need type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The need type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NeedType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for need type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NeedType->delete($id)) {
			$this->Session->setFlash(__('Need type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Need type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
