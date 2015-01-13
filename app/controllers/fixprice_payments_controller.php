<?php
class FixpricePaymentsController extends AppController {

	var $name = 'FixpricePayments';

	function admin_index() {
		$this->FixpricePayment->recursive = 0;
		$this->set('fixpricePayments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice payment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpricePayment', $this->FixpricePayment->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpricePayment->create();
			if ($this->FixpricePayment->save($this->data)) {
				$this->Session->setFlash(__('The fixprice payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice payment could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice payment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpricePayment->save($this->data)) {
				$this->Session->setFlash(__('The fixprice payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice payment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpricePayment->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice payment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpricePayment->delete($id)) {
			$this->Session->setFlash(__('Fixprice payment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice payment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
