<?php
class UserImagesController extends AppController {

	var $name = 'UserImages';

	function admin_index() {
		$this->UserImage->recursive = 0;
		$this->set('userImages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userImage', $this->UserImage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->UserImage->create();
			if ($this->UserImage->save($this->data)) {
				$this->Session->setFlash(__('The user image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user image could not be saved. Please, try again.', true));
			}
		}
		$userProfiles = $this->UserImage->UserProfile->find('list');
		$this->set(compact('userProfiles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserImage->save($this->data)) {
				$this->Session->setFlash(__('The user image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserImage->read(null, $id);
		}
		$userProfiles = $this->UserImage->UserProfile->find('list');
		$this->set(compact('userProfiles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserImage->delete($id)) {
			$this->Session->setFlash(__('User image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
