<?php
class FixpriceTypesController extends AppController {

	var $name = 'FixpriceTypes';

	function admin_index() {
		$this->FixpriceType->recursive = 0;
		$this->set('fixpriceTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceType', $this->FixpriceType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceType->create();
			if ($this->FixpriceType->save($this->data)) {
				$this->Session->setFlash(__('The fixprice type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceType->save($this->data)) {
				$this->Session->setFlash(__('The fixprice type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceType->delete($id)) {
			$this->Session->setFlash(__('Fixprice type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
