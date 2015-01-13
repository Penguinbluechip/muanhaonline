<?php
class ProductCommentsController extends AppController {

	var $name = 'ProductComments';

	function admin_index() {
		$this->ProductComment->recursive = 0;
		$this->set('productComments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productComment', $this->ProductComment->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductComment->create();
			if ($this->ProductComment->save($this->data)) {
				$this->Session->setFlash(__('The product comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product comment could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductComment->Product->find('list');
		$users = $this->ProductComment->User->find('list');
		$this->set(compact('products', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductComment->save($this->data)) {
				$this->Session->setFlash(__('The product comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductComment->read(null, $id);
		}
		$products = $this->ProductComment->Product->find('list');
		$users = $this->ProductComment->User->find('list');
		$this->set(compact('products', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductComment->delete($id)) {
			$this->Session->setFlash(__('Product comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function add() {		
		if (!empty($this->data)) {
			$user = $this->Auth->user();
			$product = $this->ProductComment->Product->read(null, $this->data["ProductComment"]["product_id"]);
			
			$this->data["ProductComment"]["user_id"] = $user["User"]["id"];
			$this->data["ProductComment"]["create_date"] = date('Y-m-d h:i:s');
			
			if((isset($this->data["ProductComment"]["expert"]) && $this->data["ProductComment"]["expert"] == '1') && !$user["User"]["expert"])
			{
				$this->Session->setFlash(__('Thành viên không phải chuyên viên', true));
				$this->redirect(array('controller'=>'products', 'action'=>'details',
								'city'=>strtolower(Inflector::slug($product["City"]["name"])),
								'id'=>$product["Product"]["id"],
								'name'=>strtolower(Inflector::slug($product["Product"]["name"]))));
			}
			
			$this->ProductComment->create();
			if ($this->ProductComment->save($this->data)) {
				$this->Session->setFlash(__('Lời bình đã được đăng thành công', true));
				if(isset($this->data["ProductComment"]["expert"]) && $this->data["ProductComment"]["expert"] == '1')
					$this->Session->setFlash(__('Nhận xét đã được đăng thành công', true));
				$this->redirect(array('controller'=>'products', 'action'=>'details',
								'city'=>strtolower(Inflector::slug($product["City"]["name"])),
								'id'=>$product["Product"]["id"],
								'name'=>strtolower(Inflector::slug($product["Product"]["name"]))));
			} else {
				$this->Session->setFlash(__('Không thể lưu lời bình, vui lòng thử lại.', true));
			}
		}
		
	}
}
