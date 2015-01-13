<?php
class FavoritesController extends AppController {

	var $name = 'Favorites';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('addFavorite', 'removeFavorite');
        }

	function manager_index() {
		$this->Favorite->recursive = 0;
		Controller::loadModel('ProductImage');
		
		$user = $this->Auth->user();
		
		//Get all filters
		$conditions = array('Favorite.user_id'=>$user["User"]["id"]);
		
		$this->paginate = array('conditions'=>$conditions);
		
		$favorites = $this->paginate();
		
		$products = array();
		foreach($favorites as $f)
		{
			$p = $this->Favorite->Product->read(null, $f['Product']['id']);
			$p['Favorite'] = $f['Favorite'];
			
			$products[] = $p;
		}
		
		foreach($products as $key => $p)
		{
			$image = $this->ProductImage->find('first', array(
									'conditions'=>array(
										'ProductImage.product_id'=>$p["Product"]["id"]
									)
								));
			$products[$key]['ProductImage'] = $image["ProductImage"];
			
			$products[$key]["Product"]["link"] = array('manager'=>false,'controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
			
			
			//perm2
			if($p['Product']['price_perm2'] == 1)
				$products[$key]['Product']['price_perm2'] = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$products[$key]['Product']['price_perm2'] = "/tháng";
			else $products[$key]['Product']['price_perm2'] = "";
			
		}
		
		$this->set('products', $products);
	}

	function manager_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('favorite', $this->Favorite->read(null, $id));
	}

	function manager_add() {
		if (!empty($this->data)) {
			$this->Favorite->create();
			if ($this->Favorite->save($this->data)) {
				$this->Session->setFlash(__('The favorite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The favorite could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Favorite->User->find('list');
		$products = $this->Favorite->Product->find('list');
		$this->set(compact('users', 'products'));
	}
	
	function addFavorite($id = null) {
		$user = $this->Auth->user();
		
		if (!$id || empty($user)) {
			$this->Session->setFlash(__('Trang truy xuất không hợp lệ', true));
			$this->redirect(array('controller'=>'home', 'action' => 'index'));
		}
		
		$product = $this->Favorite->Product->read(null, $id);
		$favorite["Favorite"]["user_id"] = $user['User']['id'];
		$favorite["Favorite"]["product_id"] = $product['Product']['id'];		
		$favorite["Favorite"]["create_date"] = date('Y-m-d H:i:s');
		
		$this->Favorite->create();
		if ($this->Favorite->save($favorite)) {
			$this->Session->setFlash(__('Bạn đã thêm sản phẩm vào lưu trữ. Xem <a target="_blank" class="favorite_link" href="'.Router::url(array('controller'=>'favorites', 'action'=>'index','manager'=>true), true).'">danh sách lưu trữ</a>.', true));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The favorite could not be saved. Please, try again.', true));
		}
		
		$this->redirect($this->referer());
	}
	
	function removeFavorite($id = null) {
		$user = $this->Auth->user();
		
		if (!$id || empty($user)) {
			$this->Session->setFlash(__('Trang truy xuất không hợp lệ', true));
			$this->redirect(array('controller'=>'home', 'action' => 'index'));
		}
		
		$product = $this->Favorite->Product->read(null, $id);
		$ef = $this->Favorite->find('first', array(
                                                                    'conditions'=>array(
                                                                        'Favorite.user_id'=>$user['User']['id'],
                                                                        'Favorite.product_id'=>$product["Product"]["id"]
                                                                    )   
                                                            ));
		if($ef)
			if ($this->Favorite->delete($ef['Favorite']['id'])) {
				$this->Session->setFlash(__('Bạn đã loại sản phẩm khỏi lưu trữ. Xem <a target="_blank" class="favorite_link" href="'.Router::url(array('controller'=>'favorites', 'action'=>'index','manager'=>true), true).'">danh sách lưu trữ</a>.', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The favorite could not be saved. Please, try again.', true));
			}
		$this->redirect($this->referer());
	}

	function manager_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Favorite->save($this->data)) {
				$this->Session->setFlash(__('The favorite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The favorite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Favorite->read(null, $id);
		}
		$users = $this->Favorite->User->find('list');
		$products = $this->Favorite->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for favorite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Favorite->delete($id)) {
			$this->Session->setFlash(__('Favorite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Favorite was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
