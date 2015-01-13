<?php
class FixpriceServicesController extends AppController {

	var $name = 'FixpriceServices';

	function admin_index() {
		$this->FixpriceService->recursive = 0;
		$this->set('fixpriceServices', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice service', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceService', $this->FixpriceService->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceService->create();
			if ($this->FixpriceService->save($this->data)) {
				$this->Session->setFlash(__('The fixprice service has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice service could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice service', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceService->save($this->data)) {
				$this->Session->setFlash(__('The fixprice service has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice service could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceService->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice service', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceService->delete($id)) {
			$this->Session->setFlash(__('Fixprice service deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice service was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
