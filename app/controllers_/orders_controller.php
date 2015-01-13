<?php
class OrdersController extends AppController {

	var $name = 'Orders';	

	function manager_index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	function manager_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('controller'=>'products', 'action' => 'index'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}

	function manager_add($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->data["Order"]["date"]=date( 'Y-m-d H:i:s');
			$this->data["Order"]["code"]="MNOBDS000".$this->data["Order"]["product_id"];
			$this->data["Order"]["status"]="new";
			
			$this->Order->create();
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('Loại hình thanh toán đã được chọn. Bạn hãy xác nhận và thanh toán.', true));
				
				//Publish product
				$pt = $this->Order->Product->read(null, $this->data["Order"]["product_id"]);
				$pt["Product"]["published"] = 1;
				$this->Order->Product->save($pt);
				
				
				$this->redirect(array('controller'=>'orders', 'action' => 'checkout', $this->Order->id));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Order->User->find('list');
		$products = $this->Order->Product->find('list');
		$orderTypes = $this->Order->OrderType->find('list');
		$this->set(compact('users', 'products', 'orderTypes', 'id'));
	}
	
	function manager_checkout($id = null) {	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Đơn hàng không hợp lệ', true));
			$this->redirect(array('controller'=>'products', 'action' => 'index'));
		}
		
		$checkout_link = '';
		
		App::import('Lib', 'nganluong');
		//echo $this->data["Order"]["id"]."sdfsdfsfsf";
			
		$this->data = $this->Order->read(null, $id);
			
		$nganluong = new NL_Checkout();
		$checkout_link = $nganluong->buildCheckoutUrl("http://muanhaonline.com.vn", "duy.duc87@gmail.com", "", $this->data["Order"]["code"],  $this->data["OrderType"]["price"]);
		
		
		$order = $this->data;
		$order["OrderType"]["price"] = number_format($order["OrderType"]["price"],0,".", ",");
			
		$this->set(compact('order', 'checkout_link'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('The order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Order->read(null, $id);
		}
		$users = $this->Order->User->find('list');
		$products = $this->Order->Product->find('list');
		$orderTypes = $this->Order->OrderType->find('list');
		$this->set(compact('users', 'products', 'orderTypes'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for order', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Order->delete($id)) {
			$this->Session->setFlash(__('Order deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Order was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
