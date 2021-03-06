<?php
class CertificatesController extends AppController {

	var $name = 'Certificates';

	function admin_index() {
		$this->Certificate->recursive = 0;
		$this->set('certificates', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid certificate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('certificate', $this->Certificate->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Certificate->create();
			if ($this->Certificate->save($this->data)) {
				$this->Session->setFlash(__('The certificate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The certificate could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid certificate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Certificate->save($this->data)) {
				$this->Session->setFlash(__('The certificate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The certificate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Certificate->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for certificate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Certificate->delete($id)) {
			$this->Session->setFlash(__('Certificate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Certificate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
