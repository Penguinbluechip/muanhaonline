<?php
class ProductsCommentsController extends AppController {

	var $name = 'ProductsComments';

	function user_index() {
		$this->ProductsComment->recursive = 0;
		$this->set('productsComments', $this->paginate());
	}

	function user_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid products comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productsComment', $this->ProductsComment->read(null, $id));
	}

	function user_add() {
		if (!empty($this->data)) {
			$this->ProductsComment->create();
			if ($this->ProductsComment->save($this->data)) {
				$this->Session->setFlash(__('The products comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products comment could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductsComment->Product->find('list');
		$users = $this->ProductsComment->User->find('list');
		$this->set(compact('products', 'users'));
	}

	function user_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid products comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductsComment->save($this->data)) {
				$this->Session->setFlash(__('The products comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductsComment->read(null, $id);
		}
		$products = $this->ProductsComment->Product->find('list');
		$users = $this->ProductsComment->User->find('list');
		$this->set(compact('products', 'users'));
	}

	function user_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for products comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductsComment->delete($id)) {
			$this->Session->setFlash(__('Products comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Products comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
