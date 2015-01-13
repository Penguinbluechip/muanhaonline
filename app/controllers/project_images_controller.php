<?php
class ProjectImagesController extends AppController {

	var $name = 'ProjectImages';

	function admin_index() {
		$this->ProjectImage->recursive = 0;
		$this->set('projectImages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('projectImage', $this->ProjectImage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProjectImage->create();
			if ($this->ProjectImage->save($this->data)) {
				$this->Session->setFlash(__('The project image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project image could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->ProjectImage->Project->find('list');
		$this->set(compact('projects'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProjectImage->save($this->data)) {
				$this->Session->setFlash(__('The project image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProjectImage->read(null, $id);
		}
		$projects = $this->ProjectImage->Project->find('list');
		$this->set(compact('projects'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProjectImage->delete($id)) {
			$this->Session->setFlash(__('Project image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_ajaxdelete($id = null) {
		$this->layout = null;
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product image', true));
			//$this->redirect(array('action'=>'index'));
			$result = "false";
			$this->set(compact('result'));
			return;
		}
		if ($this->ProjectImage->delete($id)) {
			$this->Session->setFlash(__('Project image deleted', true));
			//$this->redirect(array('action'=>'index'));
			$result = "true";
			$this->set(compact('result'));
			return;
		}
		$this->Session->setFlash(__('Project image was not deleted', true));
		//$this->redirect(array('action' => 'index'));
		$result = "false";
		$this->set(compact('result'));
	}
	
	function manager_ajaxdelete($id = null) {
		$this->layout = null;
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product image', true));
			//$this->redirect(array('action'=>'index'));
			$result = "false";
			$this->set(compact('result'));
			return;
		}
		if ($this->ProjectImage->delete($id)) {
			$this->Session->setFlash(__('Project image deleted', true));
			//$this->redirect(array('action'=>'index'));
			$result = "true";
			$this->set(compact('result'));
			return;
		}
		$this->Session->setFlash(__('Project image was not deleted', true));
		//$this->redirect(array('action' => 'index'));
		$result = "false";
		$this->set(compact('result'));
	}
}
