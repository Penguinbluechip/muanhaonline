<?php
class ProductImagesController extends AppController {

	var $name = 'ProductImages';

	function admin_index() {
		$this->ProductImage->recursive = 0;
		$this->set('productImages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productImage', $this->ProductImage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductImage->create();
			if ($this->ProductImage->save($this->data)) {
				$this->Session->setFlash(__('The product image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductImage->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductImage->save($this->data)) {
				$this->Session->setFlash(__('The product image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductImage->read(null, $id);
		}
		$products = $this->ProductImage->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductImage->delete($id)) {
			$this->Session->setFlash(__('Product image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product image was not deleted', true));
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
		if ($this->ProductImage->delete($id)) {
			$this->Session->setFlash(__('Product image deleted', true));
			//$this->redirect(array('action'=>'index'));
			$result = "true";
			$this->set(compact('result'));
			return;
		}
		$this->Session->setFlash(__('Product image was not deleted', true));
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
		
		//check if user has role on this product
		Controller::loadModel('User');
		$user = $this->Auth->user();		
		if(!$this->User->isUserImage($user["User"]["id"], $id))
		{
			$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
			//echo "sdf sf sdf sdf sdf ";
			return;
		}		
		
		if ($this->ProductImage->delete($id)) {
			$this->Session->setFlash(__('Product image deleted', true));
			//$this->redirect(array('action'=>'index'));
			$result = "true";
			$this->set(compact('result'));
			return;
		}
		$this->Session->setFlash(__('Product image was not deleted', true));
		//$this->redirect(array('action' => 'index'));
		$result = "false";
		$this->set(compact('result'));
	}
	
	function ajaxdelete($id = null) {
		$this->layout = null;
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product image', true));
			//$this->redirect(array('action'=>'index'));
			$result = "false";
			$this->set(compact('result'));
			return;
		}
		
		//check if user has role on this product
		Controller::loadModel('User');
		$user = $this->Auth->user();		
		if(!$this->User->isUserImage($user["User"]["id"], $id))
		{
			$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
			//echo "sdf sf sdf sdf sdf ";
			return;
		}		
		
		if ($this->ProductImage->delete($id)) {
			$this->Session->setFlash(__('Product image deleted', true));
			//$this->redirect(array('action'=>'index'));
			$result = "true";
			$this->set(compact('result'));
			return;
		}
		$this->Session->setFlash(__('Product image was not deleted', true));
		//$this->redirect(array('action' => 'index'));
		$result = "false";
		$this->set(compact('result'));
	}
}
