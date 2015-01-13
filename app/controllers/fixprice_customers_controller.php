<?php
class FixpriceCustomersController extends AppController {

	var $name = 'FixpriceCustomers';

	function admin_index() {
		$this->FixpriceCustomer->recursive = 0;
		$this->set('fixpriceCustomers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice customer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceCustomer', $this->FixpriceCustomer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceCustomer->create();
			if ($this->FixpriceCustomer->save($this->data)) {
				$this->Session->setFlash(__('The fixprice customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice customer could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice customer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceCustomer->save($this->data)) {
				$this->Session->setFlash(__('The fixprice customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice customer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceCustomer->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice customer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceCustomer->delete($id)) {
			$this->Session->setFlash(__('Fixprice customer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice customer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
