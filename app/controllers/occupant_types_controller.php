<?php
class OccupantTypesController extends AppController {

	var $name = 'OccupantTypes';

	function admin_index() {
		$this->OccupantType->recursive = 0;
		$this->set('occupantTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid occupant type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('occupantType', $this->OccupantType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OccupantType->create();
			if ($this->OccupantType->save($this->data)) {
				$this->Session->setFlash(__('The occupant type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The occupant type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid occupant type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OccupantType->save($this->data)) {
				$this->Session->setFlash(__('The occupant type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The occupant type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OccupantType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for occupant type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OccupantType->delete($id)) {
			$this->Session->setFlash(__('Occupant type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Occupant type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
