<?php
class CompaniesController extends AppController {

	var $name = 'Companies';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('index', 'reset', 'companiesByCat', 'details');
        }
	
	function index() {
		$this->layout = 'home';
		$this->Company->recursive = 0;		
		$conditions = array();
		//filter category
		if(!empty($this->params['form']['filter_category_id']) || (isset($this->params['form']['filter_category_id']) && $this->params['form']['filter_category_id'] == 0))
		{
			$company_cat_id = $this->params['form']['filter_category_id'];
		}
		else
			$company_cat_id = $this->Session->read("filter_company_category_id");
		
		if(isset($this->params['filter_category_id']))
		{
			$company_cat_id = $this->params['filter_category_id'];
		}
		
		$this->Session->write("filter_company_category_id", $company_cat_id);		
		$cats = $this->Company->CompanyCategory->find('all');
		$cat = "";
		if($company_cat_id)
		{
			$conditions["Company.company_category_id"] = $company_cat_id;
			$cat = $this->Company->CompanyCategory->find('first',array('conditions'=>array('CompanyCategory.id'=>$company_cat_id)));
		}		
		
		//filter keyword		
		if(!empty($this->params['form']['filter_keyword']) || (isset($this->params['form']['filter_keyword']) && $this->params['form']['filter_keyword'] == ''))
		{
			$keyword = $this->params['form']['filter_keyword'];
		}
		else
			$keyword = $this->Session->read("filter_company_keyword");
		$this->Session->write("filter_company_keyword", $keyword);
		if($keyword != '')
		{			
			$or = array();
			foreach(explode(' ',$keyword) as $part)
			{
				$or[] = "Company.name LIKE '%".$part."%'";
				//$or[] = "Company.description LIKE '%".$part."%'";
			}
			//var_dump($or);
			$conditions["OR"] = $or;
		}	
		
		$this->paginate = array('conditions'=>$conditions, 'limit'=>6);
		$companies = $this->paginate();
		
		
		$this->set('companies', $companies);
		$this->set('keyword', $keyword);
		$this->set('cats', $cats);
		$this->set('company_cat_id', $company_cat_id);
		$this->set('cat', $cat);
	}
	
	function reset()
	{
		$this->Session->write("filter_company_category_id", 0);
		$this->Session->write("filter_company_keyword", '');
		$this->redirect(array('action' => 'index'));
	}
	
	function companiesByCat($id = null)
	{
		$this->Session->write("filter_company_category_id", $id);
		$this->Session->write("filter_company_keyword", '');
		$this->redirect(array('action' => 'index'));
	}
	
	function details($id = null) {
		$this->layout = 'home';
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid company', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		//get users
		$users = $this->Company->UserProfile->find('all', array('conditions'=>array('UserProfile.company_id'=>$id)));
		$user_a = array();
		foreach($users as $user)
		{
			$user_a[] = $user['UserProfile']['user_id'];
		}
		
		//var_dump($user_a);
		
		$products = array();
		if(count($user_a))
		{
			Controller::loadModel('Product');
			$products = $this->Product->find('all', array('conditions'=>array('Product.user_id'=>$user_a)));
			
			$currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
			foreach($products as $key => $p)
			{
				$image = $this->Product->ProductImage->find('first', array(
										'conditions'=>array(
											'ProductImage.product_id'=>$p["Product"]["id"]
										)
									));
				$products[$key]['ProductImage'] = $image["ProductImage"];
				$products[$key]["Product"]["description"] = parent::snippet(strip_tags($p["Product"]["description"]), 120);
				$products[$key]["Product"]["sname"] = parent::snippet(strip_tags($p["Product"]["name"]), 70);
				$products[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
														     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
														     'id'=>$p["Product"]["id"],
														     'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
				//Price
				Controller::loadModel('Currency');
				if($p["Product"]["price"]) {
					if($p['Product']['price_perm2'] == 1)
						$cur = "/m2";
					else if($p['Product']['price_perm2'] == 2)
						$cur = "/tháng";
					else $cur = "";
					
					////Use for all page
					//$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
					//if($currency["Currency"]["id"] == 2)
					//	$products[$key]["Product"]["price"] = parent::priceFormat(($p["Product"]["price"]*$currency["Currency"]["rate"])/str_replace(',', '.', $p["CurrencyPrice"]["rate"])).$cur;
					//else
					//{
					//	$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
					//	$products[$key]["Product"]["price"] = number_format(($p["Product"]["price"]*$currency["Currency"]["rate"])/str_replace(',', '.', $p["CurrencyPrice"]["rate"]),$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
					//}
					
					//use for each product
					
					foreach($currency_list as $item)
					{
						$value = ($p["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $p["CurrencyPrice"]["rate"]);
						
						if($item["Currency"]["id"] == 2)
							$value = parent::priceFormat(($p["Product"]["price"]*$item["Currency"]["rate"])/$p["CurrencyPrice"]["rate"]).$cur;
						else
						{
							$tp = $item["Currency"]["id"] == 3 ? 3 : 0;
							$value = number_format(($p["Product"]["price"]*$item["Currency"]["rate"])/$p["CurrencyPrice"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
						}
						
						$products[$key]["prices"][$item['Currency']['id']] = array(
										    'id'=>$item['Currency']['id'],
										    'code'=>$item['Currency']['code'],
										    'value'=>$value
									);
					}
				}
				else
				{
					$products[$key]["Product"]["price"] = 0;
				}
				
				//format date
				$products[$key]["Product"]["ncreate_date"] = $p["Product"]["create_date"];
				$products[$key]["Product"]["create_date"] = parent::dateFormat($p["Product"]["create_date"]);
			}
		}
		//echo count($products);
		
		$this->set('company', $this->Company->read(null, $id));
	}

	function admin_index() {
		$this->Company->recursive = 0;
		$this->set('companies', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid company', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('company', $this->Company->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Company->create();
			if ($this->Company->save($this->data)) {
				
				//var_dump($this->data["UserImage"]);
				$this->data["CompanyImage"]["company_id"] = $this->Company->id;
				$this->Company->CompanyImage->create();
				if ($this->Company->CompanyImage->save($this->data["CompanyImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				
				$this->Session->setFlash(__('The company has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.', true));
			}
		}
		$companyCategories = $this->Company->CompanyCategory->find('list');
		$this->set(compact('companyCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid company', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Company->save($this->data)) {
				$this->Session->setFlash(__('The company has been saved', true));
				
				if($this->data["CompanyImage"]["filename"]["name"] != "")
				{
					$company = $this->Company->read(null, $id);
					$this->Company->CompanyImage->delete($company["CompanyImage"]["id"]);
				}
				
				$this->data["CompanyImage"]["company_id"] = $id;
				$this->Company->CompanyImage->create();
				if ($this->Company->CompanyImage->save($this->data["CompanyImage"])) {
					$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
				} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Company->read(null, $id);
		}
		$companyCategories = $this->Company->CompanyCategory->find('list');
		$this->set(compact('companyCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for company', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Company->delete($id)) {
			$this->Session->setFlash(__('Company deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Company was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
