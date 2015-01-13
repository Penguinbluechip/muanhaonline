<?php
class NeedsController extends AppController {

	var $name = 'Needs';
	
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('guest_add');
        }
	
	function guest_add()
	{
		$this->layout = "home";
		Controller::loadModel('NeedType');
		Controller::loadModel('Category');
		Controller::loadModel('City');
		Controller::loadModel('District');
		$user = $this->Auth->user();
		
		$city_id = 1;
		
		if (empty($this->data)) {
			$this->data['Need']['need_types'] = '';
			$this->data['Need']['categories'] = '';
			$this->data['Need']['districts'] = '';
			$this->data['Need']['directions'] = '';
			$this->data['Need']['for'] = '';
		}
		else if (!empty($this->data)) {
			$this->Need->create();
			
			//user
			$this->data['Need']['user_id'] = "0";
			
			//city
			$city_id = $this->data['Need']['city_id'];
			
			$this->data['Need']['price_from'] = str_replace(',', '', $this->data['Need']['price_from']);
			$this->data['Need']['price_to'] = str_replace(',', '', $this->data['Need']['price_to']);
			
			//For
			if(isset($this->data['Need']['for']))
			{
				$arr = array();
				foreach($this->data['Need']['for'] as $key => $value)
				{
					$arr[] = $key;
				}
				$this->data['Need']['for'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['for'] = '';
			}
			
			//Need Type
			if(isset($this->data['Need']['need_types']))
			{
				$arr = array();
				foreach($this->data['Need']['need_types'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['need_types'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['need_types'] = '';
			}
			
			//Categories
			if(isset($this->data['Need']['categories']))
			{
				$arr = array();
				foreach($this->data['Need']['categories'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['categories'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['categories'] = '';
			}
			
			//districts
			if(isset($this->data['Need']['districts']))
			{
				$arr = array();
				foreach($this->data['Need']['districts'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['districts'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['districts'] = '';
			}
			
			//directions
			if(isset($this->data['Need']['directions']))
			{
				$arr = array();
				foreach($this->data['Need']['directions'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['directions'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['directions'] = '';
			}
			
			if ($this->Need->save($this->data)) {
				$this->Session->setFlash(__('Nhu cầu được thêm thành công. Chúng tôi sẽ cung cấp thông tin mới nhất cho bạn.', true));
				$this->redirect(array('controller'=>'home', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Có lỗi trong quá trình lưu.', true));
			}
		}
		
		$users = $this->Need->User->find('list');
		$currencies = $this->Need->Currency->find('list', array('fields'=>array('id', 'code'),'order'=>'Currency.order'));
		$need_types = $this->NeedType->find('all');
		$categories = $this->Category->find('all');
		$cities = $this->City->find('list');
		$this->data["Need"]["city_id"] = $city_id;
		$districts = $this->District->find('all', array("conditions"=>array("city_id"=>$city_id)));
		
		
		
		Controller::loadModel('Product');
		//Get all filters
		$conditions = array("published"=>1);
		
		//filter category
		//$cat_id = !empty($this->params['form']['filter_category_id']) ? $this->params['form']['filter_category_id'] : 0;
		if(!empty($this->params['form']['filter_category_id']) || (isset($this->params['form']['filter_category_id']) && $this->params['form']['filter_category_id'] == 0))
		{
			$cat_id = $this->params['form']['filter_category_id'];
		}
		else
			$cat_id = $this->Session->read("filter_category_id");
		
		if(isset($this->params['filter_category_id']))
		{
			$cat_id = $this->params['filter_category_id'];
		}
		
		$this->Session->write("filter_category_id", $cat_id);
		
		
		$cats = $this->Product->Category->find('all');
		$cat = "";
		if($cat_id)
		{
			$conditions["Product.category_id"] = $cat_id;
			$cat = $this->Product->Category->find('first',array('conditions'=>array('Category.id'=>$cat_id)));
		}
		
		//filter for		
		if(!empty($this->params['form']['filter_for']) || (isset($this->params['form']['filter_for']) && $this->params['form']['filter_for'] == 0))
		{
			$for = $this->params['form']['filter_for'];
		}
		else
			$for = $this->Session->read("filter_for");
		//echo $for."ooo";	
		$this->Session->write("filter_for", $for);
		//echo $for."ooo";
		
		if($for)
		{
			$conditions["Product.for"] = $for;				
		}
		
		
		
		//filter bedrooms		
		if(!empty($this->params['form']['filter_bedrooms']) || (isset($this->params['form']['filter_bedrooms']) && $this->params['form']['filter_bedrooms'] == 0))
		{
			$bedrooms = $this->params['form']['filter_bedrooms'];
		}
		else
			$bedrooms = $this->Session->read("filter_bedrooms");
		$this->Session->write("filter_bedrooms", $bedrooms);
		if($bedrooms)
		{
			$conditions["Product.bedrooms >="] = $bedrooms;				
		}
		
		//filter bathrooms		
		if(!empty($this->params['form']['filter_bathrooms']) || (isset($this->params['form']['filter_bathrooms']) && $this->params['form']['filter_bathrooms'] == 0))
		{
			$bathrooms = $this->params['form']['filter_bathrooms'];
		}
		else
			$bathrooms = $this->Session->read("filter_bathrooms");
		$this->Session->write("filter_bathrooms", $bathrooms);
		if($bathrooms)
		{
			$conditions["Product.bedrooms >="] = $bathrooms;				
		}
		
		//filter district		
		if(!empty($this->params['form']['filter_city_id']) || (isset($this->params['form']['filter_city_id']) && $this->params['form']['filter_city_id'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id'];
		}
		else
			$city_id = $this->Session->read("filter_city_id");
		$this->Session->write("filter_city_id", $city_id);
		if($city_id)
		{
			$conditions["Product.city_id"] = $city_id;
			$districtsz = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			$projects = array();
		}
		else
		{
			$districtsz = array();
			$projects = array();
		}
		
		//filter district		
		if(!empty($this->params['form']['filter_district_id']) || (isset($this->params['form']['filter_district_id']) && $this->params['form']['filter_district_id'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id'];
		}
		else
			$district_id = $this->Session->read("filter_district_id");
		$this->Session->write("filter_district_id", $district_id);
		
		$districtsz = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		if($district_id)
		{
			$conditions["Product.district_id"] = $district_id;			
			$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		}
		
		//filter project		
		if(!empty($this->params['form']['filter_project_id']) || (isset($this->params['form']['filter_project_id']) && $this->params['form']['filter_project_id'] == 0))
		{
			$project_id = $this->params['form']['filter_project_id'];
		}
		else
			$project_id = $this->Session->read("filter_project_id");
		$this->Session->write("filter_project_id", $project_id);
		
		$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		if($project_id)
		{
			$conditions["Product.project_id"] = $project_id;			
			//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			$project = $this->Product->Project->find('first',array('conditions'=>array('Project.id'=>$project_id)));
			$this->set('project', $project);
		}
		
		//filter keyword		
		if(!empty($this->params['form']['filter_keyword']) || (isset($this->params['form']['filter_keyword']) && $this->params['form']['filter_keyword'] == ''))
		{
			$keyword = $this->params['form']['filter_keyword'];
		}
		else
			$keyword = $this->Session->read("filter_keyword");
		$this->Session->write("filter_keyword", $keyword);
		//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		if($keyword != '')
		{
			//$conditions["Product.name LIKE ?"] = '%'.$keyword.'%';
			# sanitize the query
			//App::import('Sanitize');
			//$keyword = Sanitize::escape($keyword);
			//$conditions[] = 'MATCH(Product.name) AGAINST(\''.$keyword.'\' WITH QUERY EXPANSION)';
			//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			
			$or = array();
			foreach(explode(' ',$keyword) as $part)
			{
				$or[] = "Product.name LIKE '%".$part."%'";
				$or[] = "Product.description LIKE '%".$part."%'";
			}
			//var_dump($or);
			$conditions["OR"] = $or;
		}
		
		//filter product price
		if(isset($this->params['form']['filter_product_price']) && $this->params['form']['filter_product_price'] == "-1")
		{
			$from = str_replace(',','',$this->params['form']['filter_price_from']);
			$to = str_replace(',','',$this->params['form']['filter_price_to']);
			
			$from = $from != '' ? $from."000000" : "";
			$to = $to != '' ? $to."000000" : "";
			
			$this->params['form']['filter_product_price'] = $from."-".$to;
		}
		if(!empty($this->params['form']['filter_product_price']) || (isset($this->params['form']['filter_product_price']) && $this->params['form']['filter_product_price'] == ''))
		{			
			$price_range = $this->params['form']['filter_product_price'];
		}
		else
			$price_range = $this->Session->read("filter_product_price");
		$this->Session->write("filter_product_price", $price_range);
		
		//echo $price_range;
		if($price_range != '' && $price_range != '0')
		{
			$price_arr = explode('-', $price_range);
			//var_dump($price_arr);
			$s_price = $price_arr[0] != '' ? $price_arr[0] : 0;
			$e_price = $price_arr[1] != '' ? $price_arr[1] : 1000000000000000000;
			//echo $s_price."sd".$e_price;
			//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			if($price_range != '')
			{
				$conditions["Product.price BETWEEN ? AND ?"] = array($s_price, $e_price);			
				//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			}
		}
		
		//filter product area			
		if(!empty($this->params['form']['filter_product_area']) || (isset($this->params['form']['filter_product_area']) && $this->params['form']['filter_product_area'] == ''))
		{
			$area_range = $this->params['form']['filter_product_area'];
		}
		else
			$area_range = $this->Session->read("filter_product_area");
		$this->Session->write("filter_product_area", $area_range);
		
		if($area_range != '' && $area_range != '0')
		{
			$area_arr = explode('-', $area_range);
			//var_dump($price_arr);
			$s_area = $area_arr[0] != '' ? $area_arr[0] : 0;
			$e_area = $area_arr[1] != '' ? $area_arr[1] : 10000000000;
			//echo $s_price."sd".$e_price;
			//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			if($area_range != '')
			{
				$conditions["Product.property_area BETWEEN ? AND ?"] = array($s_area, $e_area);			
				//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			}
		}
		$citiesz = $this->Product->City->find('all');		
		$types = $this->Product->Type->find('all');
		
		//$this->set('products', $products);
		$this->set('citiesz', $citiesz);
		$this->set('city_id', $city_id);
		$this->set('districtsz', $districtsz);
		$this->set('district_id', $district_id);
		$this->set('projects', $projects);
		$this->set('project_id', $project_id);
		$this->set('keyword', $keyword);
		$this->set('price_range', $price_range);
		$this->set('area_range', $area_range);
		$this->set('cats', $cats);
		$this->set('cat_id', $cat_id);
		$this->set('cat', $cat);
		$this->set('for', $for);
		$this->set('bedrooms', $bedrooms);
		$this->set('bathrooms', $bathrooms);
		$this->set('types', $types);
		//$this->set('currency_list', $currency_list);
		
		
		
		$this->set(compact('users', 'need_types', 'categories', 'cities', 'districts', 'currencies'));
	}

	function manager_index() {
		$this->Need->recursive = 0;
		$user = $this->Auth->user();
		
		$this->paginate = array('conditions'=>array('Need.user_id'=>$user['User']['id']));
		
		
		$this->set('needs', $this->paginate());
	}

	function manager_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid need', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('need', $this->Need->read(null, $id));
	}

	function manager_add() {
		Controller::loadModel('NeedType');
		Controller::loadModel('Category');
		Controller::loadModel('City');
		Controller::loadModel('District');
		$user = $this->Auth->user();
		
		$city_id = 1;
		
		if (empty($this->data)) {
			$this->data['Need']['need_types'] = '';
			$this->data['Need']['categories'] = '';
			$this->data['Need']['districts'] = '';
			$this->data['Need']['directions'] = '';
			$this->data['Need']['for'] = '';
		}
		else if (!empty($this->data)) {
			$this->Need->create();
			
			//user
			$this->data['Need']['user_id'] = $user["User"]["id"];
			
			$this->data['Need']['price_from'] = str_replace(',', '', $this->data['Need']['price_from']);
			$this->data['Need']['price_to'] = str_replace(',', '', $this->data['Need']['price_to']);
			
			//city
			$city_id = $this->data['Need']['city_id'];
			
			//For
			if(isset($this->data['Need']['for']))
			{
				$arr = array();
				foreach($this->data['Need']['for'] as $key => $value)
				{
					$arr[] = $key;
				}
				$this->data['Need']['for'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['for'] = '';
			}
			
			//Need Type
			if(isset($this->data['Need']['need_types']))
			{
				$arr = array();
				foreach($this->data['Need']['need_types'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['need_types'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['need_types'] = '';
			}
			
			//Categories
			if(isset($this->data['Need']['categories']))
			{
				$arr = array();
				foreach($this->data['Need']['categories'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['categories'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['categories'] = '';
			}
			
			//districts
			if(isset($this->data['Need']['districts']))
			{
				$arr = array();
				foreach($this->data['Need']['districts'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['districts'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['districts'] = '';
			}
			
			//directions
			if(isset($this->data['Need']['directions']))
			{
				$arr = array();
				foreach($this->data['Need']['directions'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['directions'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['directions'] = '';
			}
			
			if ($this->Need->save($this->data)) {
				$this->Session->setFlash(__('Nhu cầu được thêm thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Có lỗi trong quá trình lưu.', true));
			}
		}
		
		$users = $this->Need->User->find('list');
		$currencies = $this->Need->Currency->find('list', array('fields'=>array('id', 'code'),'order'=>'Currency.order'));
		$need_types = $this->NeedType->find('all');
		$categories = $this->Category->find('all');
		$cities = $this->City->find('list');
		$this->data["Need"]["city_id"] = $city_id;
		$districts = $this->District->find('all', array("conditions"=>array("city_id"=>$city_id)));		
		$this->set(compact('users', 'need_types', 'categories', 'cities', 'districts', 'currencies'));
	}

	function manager_edit($id = null) {
		Controller::loadModel('NeedType');
		Controller::loadModel('Category');
		Controller::loadModel('City');
		Controller::loadModel('District');
		$user = $this->Auth->user();
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid need', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Need->User->isUserNeed($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this need', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		if (!empty($this->data)) {
			
			$this->data['Need']['price_from'] = str_replace(',', '', $this->data['Need']['price_from']);
			$this->data['Need']['price_to'] = str_replace(',', '', $this->data['Need']['price_to']);
			
			
			//For
			if(isset($this->data['Need']['for']))
			{
				$arr = array();
				foreach($this->data['Need']['for'] as $key => $value)
				{
					$arr[] = $key;
				}
				$this->data['Need']['for'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['for'] = '';
			}
			
			//Need Type
			if(isset($this->data['Need']['need_types']))
			{
				$arr = array();
				foreach($this->data['Need']['need_types'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['need_types'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['need_types'] = '';
			}
			
			//Categories
			if(isset($this->data['Need']['categories']))
			{
				$arr = array();
				foreach($this->data['Need']['categories'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['categories'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['categories'] = '';
			}
			
			//districts
			if(isset($this->data['Need']['districts']))
			{
				$arr = array();
				foreach($this->data['Need']['districts'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['districts'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['districts'] = '';
			}
			
			//directions
			if(isset($this->data['Need']['directions']))
			{
				$arr = array();
				foreach($this->data['Need']['directions'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['directions'] = ','.implode(',', $arr).',';
			}
			else
			{
				$this->data['Need']['directions'] = '';
			}
			
			if ($this->Need->save($this->data)) {
				$this->Session->setFlash(__('Nhu cầu được lưu thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Có lỗi trong quá trình lưu.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Need->read(null, $id);
		}
		$users = $this->Need->User->find('list');
		$currencies = $this->Need->Currency->find('list', array('fields'=>array('id', 'code'),'order'=>'Currency.order'));
		$need_types = $this->NeedType->find('all');
		$categories = $this->Category->find('all');
		$cities = $this->City->find('list');
		$this->data["Need"]["city_id"] = $this->data['Need']['city_id'];
		$districts = $this->District->find('all', array("conditions"=>array("city_id"=>$this->data['Need']['city_id'])));
		$this->set(compact('users', 'need_types', 'categories', 'cities', 'districts', 'currencies'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for need', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$user = $this->Auth->user();
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Need->User->isUserNeed($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this need', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		if ($this->Need->delete($id)) {
			$this->Session->setFlash(__('Need deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Need was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_index() {
		$this->Need->recursive = 0;
		$this->paginate = array('order'=>'Need.create_date DESC');
		$this->set('needs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid need', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('need', $this->Need->read(null, $id));
	}

	function admin_add() {
		Controller::loadModel('NeedType');
		Controller::loadModel('Category');
		Controller::loadModel('City');
		Controller::loadModel('District');
		$user = $this->Auth->user();
		
		$city_id = 1;
		
		if (empty($this->data)) {
			$this->data['Need']['need_types'] = '';
			$this->data['Need']['categories'] = '';
			$this->data['Need']['districts'] = '';
			$this->data['Need']['directions'] = '';
			$this->data['Need']['for'] = '';
		}
		else if (!empty($this->data)) {
			$this->Need->create();
			
			//user
			$this->data['Need']['user_id'] = $user["User"]["id"];
			
			//city
			$city_id = $this->data['Need']['city_id'];
			
			//For
			if(isset($this->data['Need']['for']))
			{
				$arr = array();
				foreach($this->data['Need']['for'] as $key => $value)
				{
					$arr[] = $key;
				}
				$this->data['Need']['for'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['for'] = '';
			}
			
			//Need Type
			if(isset($this->data['Need']['need_types']))
			{
				$arr = array();
				foreach($this->data['Need']['need_types'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['need_types'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['need_types'] = '';
			}
			
			//Categories
			if(isset($this->data['Need']['categories']))
			{
				$arr = array();
				foreach($this->data['Need']['categories'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['categories'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['categories'] = '';
			}
			
			//districts
			if(isset($this->data['Need']['districts']))
			{
				$arr = array();
				foreach($this->data['Need']['districts'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['districts'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['districts'] = '';
			}
			
			//directions
			if(isset($this->data['Need']['directions']))
			{
				$arr = array();
				foreach($this->data['Need']['directions'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['directions'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['directions'] = '';
			}
			
			if ($this->Need->save($this->data)) {
				$this->Session->setFlash(__('Nhu cầu được thêm thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Có lỗi trong quá trình lưu.', true));
			}
		}
		
		$users = $this->Need->User->find('list');
		$currencies = $this->Need->Currency->find('list', array('fields'=>array('id', 'code'),'order'=>'Currency.order'));
		$need_types = $this->NeedType->find('all');
		$categories = $this->Category->find('all');
		$cities = $this->City->find('list');
		$this->data["Need"]["city_id"] = $city_id;
		$districts = $this->District->find('all', array("conditions"=>array("city_id"=>$city_id)));		
		$this->set(compact('users', 'need_types', 'categories', 'cities', 'districts', 'currencies'));
	}

	function admin_edit($id = null) {
		Controller::loadModel('NeedType');
		Controller::loadModel('Category');
		Controller::loadModel('City');
		Controller::loadModel('District');
		$user = $this->Auth->user();
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid need', true));
			$this->redirect(array('action' => 'index'));
		}		
		
		
		if (!empty($this->data)) {
			
			//Need Type
			if(isset($this->data['Need']['need_types']))
			{
				$arr = array();
				foreach($this->data['Need']['need_types'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['need_types'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['need_types'] = '';
			}
			
			//Categories
			if(isset($this->data['Need']['categories']))
			{
				$arr = array();
				foreach($this->data['Need']['categories'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['categories'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['categories'] = '';
			}
			
			//districts
			if(isset($this->data['Need']['districts']))
			{
				$arr = array();
				foreach($this->data['Need']['districts'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['districts'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['districts'] = '';
			}
			
			//directions
			if(isset($this->data['Need']['directions']))
			{
				$arr = array();
				foreach($this->data['Need']['directions'] as $key => $value)
				{
					$arr[] = $key;					
				}
				$this->data['Need']['directions'] = implode(',', $arr);
			}
			else
			{
				$this->data['Need']['directions'] = '';
			}
			
			if ($this->Need->save($this->data)) {
				$this->Session->setFlash(__('Nhu cầu được lưu thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Có lỗi trong quá trình lưu.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Need->read(null, $id);
		}
		$users = $this->Need->User->find('list');
		$currencies = $this->Need->Currency->find('list', array('fields'=>array('id', 'code'),'order'=>'Currency.order'));
		$need_types = $this->NeedType->find('all');
		$categories = $this->Category->find('all');
		$cities = $this->City->find('list');
		$this->data["Need"]["city_id"] = $this->data['Need']['city_id'];
		$districts = $this->District->find('all', array("conditions"=>array("city_id"=>$this->data['Need']['city_id'])));
		$this->set(compact('users', 'need_types', 'categories', 'cities', 'districts', 'currencies'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for need', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Need->delete($id)) {
			$this->Session->setFlash(__('Need deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Need was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
