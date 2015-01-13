<?php
class OrderTypesController extends AppController {

	var $name = 'OrderTypes';

	function admin_index() {
		$this->OrderType->recursive = 0;
		$this->set('orderTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid order type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('orderType', $this->OrderType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OrderType->create();
			if ($this->OrderType->save($this->data)) {
				$this->Session->setFlash(__('The order type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid order type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OrderType->save($this->data)) {
				$this->Session->setFlash(__('The order type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OrderType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for order type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OrderType->delete($id)) {
			$this->Session->setFlash(__('Order type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Order type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
