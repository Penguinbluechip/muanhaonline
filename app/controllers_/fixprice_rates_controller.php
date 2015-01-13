<?php
class FixpriceRatesController extends AppController {

	var $name = 'FixpriceRates';

	function admin_index() {
		$this->FixpriceRate->recursive = 0;
		$this->set('fixpriceRates', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice rate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceRate', $this->FixpriceRate->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceRate->create();
			if ($this->FixpriceRate->save($this->data)) {
				$this->Session->setFlash(__('The fixprice rate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice rate could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice rate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceRate->save($this->data)) {
				$this->Session->setFlash(__('The fixprice rate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice rate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceRate->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice rate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceRate->delete($id)) {
			$this->Session->setFlash(__('Fixprice rate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice rate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
