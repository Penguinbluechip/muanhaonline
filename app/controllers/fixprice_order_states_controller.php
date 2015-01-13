<?php
class FixpriceOrderStatesController extends AppController {

	var $name = 'FixpriceOrderStates';

	function admin_index() {
		$this->FixpriceOrderState->recursive = 0;
		$this->set('fixpriceOrderStates', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice order state', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceOrderState', $this->FixpriceOrderState->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceOrderState->create();
			if ($this->FixpriceOrderState->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order state has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order state could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order state', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceOrderState->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order state has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order state could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceOrderState->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice order state', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceOrderState->delete($id)) {
			$this->Session->setFlash(__('Fixprice order state deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice order state was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
