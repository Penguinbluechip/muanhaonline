<?php
class ProductsController extends AppController {

	var $name = 'Products';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('details', 'details_preview', 'index', 'reset', 'forRent', 'forSale', 'productsByProject', 'quick_add', 'productsByCategory', 'ajaxMap', 'getAdminSideBarCount', 'setnewpost', 'addFavorite');
        }
	
	function index()
	{
		$this->layout = 'home';
		$this->Product->recursive = 0;
		
		$user = $this->Auth->user();
		
		//var_dump($this->params);
		
		//Get all filters
		$conditions = array("published"=>2);
		$home_order = 'Product.create_date DESC';
		
		//filter order		
		if(!empty($this->params['form']['filter_order']) || (isset($this->params['form']['filter_order']) && $this->params['form']['filter_order'] == 0))
		{
			$orderz = $this->params['form']['filter_order'];
		}
		else
			$orderz = $this->Session->read("filter_order");
		$this->Session->write("filter_order", $orderz);
		if($orderz)
		{
			if($orderz == "2")
				$home_order = 'Product.price';				
		}
		
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
		
		//filter city
		$district = '';
		if(!empty($this->params['form']['filter_city_id']) || (isset($this->params['form']['filter_city_id']) && $this->params['form']['filter_city_id'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id'];
		}
		else
			$city_id = $this->Session->read("filter_city_id");
		
		if(isset($this->params['filter_city_id']))
		{
			$city_id = $this->params['filter_city_id'];
			
			//reset all district
			
			if(isset($this->params['filter_district_id']))
			{
				$this->Session->write("filter_district_id", $this->params['filter_district_id']);
				$district = $this->Product->District->find('first',array('conditions'=>array('District.id'=>$this->params['filter_district_id'])));
			}
			else
			{
				$this->Session->write("filter_district_id", "");
			}			
		}
		//var_dump($this->params);			
		$this->Session->write("filter_city_id", $city_id);
		$city = "";
		if($city_id)
		{
			$conditions["Product.city_id"] = $city_id;
			$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			$projects = array();
			
			$city = $this->Product->City->find('first',array('conditions'=>array('City.id'=>$city_id)));
		}
		else
		{
			$districts = array();
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
		
		$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		if($district_id)
		{
			$conditions["Product.district_id"] = $district_id;			
			$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
			
			$district = $this->Product->District->find('first',array('conditions'=>array('District.id'=>$district_id)));
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
		
		
		$this->paginate = array('conditions'=>$conditions, 'limit'=>30, 'order'=>$home_order);
		$products = $this->paginate();
		
		$currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
		foreach($products as $key => $p)
		{
			$image = $this->Product->ProductImage->find('first', array(
									'conditions'=>array(
										'ProductImage.product_id'=>$p["Product"]["id"]
									)
								));
			$products[$key]['ProductImage'] = $image["ProductImage"];
			$products[$key]["Product"]["description"] = parent::snippet(strip_tags($p["Product"]["description"]), 400);
			$products[$key]["Product"]["sname"] = parent::snippet(strip_tags($p["Product"]["name"]), 90);
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
                        
                        //Tin luu trữ
                        $ef = $this->Product->Favorite->find('first', array(
                                                                    'conditions'=>array(
                                                                        'Favorite.user_id'=>$user['User']['id'],
                                                                        'Favorite.product_id'=>$p["Product"]["id"]
                                                                    )   
                                                            ));
                        if($ef)
                        {
                            $products[$key]["isFavorite"] = 1;
                            $products[$key]["Product"]['Favorite'] = $ef['Favorite'];
                        }
                        else
                        {
                            $products[$key]["isFavorite"] = 0;
                        }
		}
		//var_dump($products[0]['prices']);
		
		//filter 
		$cities = $this->Product->City->find('all');
		//$districts = $this->Product->District->find('all');
		//$projects = $this->Product->Project->find('all');
		$types = $this->Product->Type->find('all');
		
		//var_dump($types);
		
		$this->set('products', $products);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);
		$this->set('city', $city);
		$this->set('districts', $districts);
		$this->set('district_id', $district_id);
		$this->set('district', $district);
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
		$this->set('currency_list', $currency_list);
		
	}
	
	function reset()
	{
		$this->Session->write("filter_category_id", 0);
		$this->Session->write("filter_for", "0");
		$this->Session->write("filter_bathrooms", 0);
		$this->Session->write("filter_bedrooms", 0);
		$this->Session->write("filter_city_id", 0);
		$this->Session->write("filter_project_id", 0);
		$this->Session->write("filter_district_id", 0);
		$this->Session->write("filter_keyword", '');
		$this->Session->write("filter_product_price", '');
		$this->Session->write("filter_product_area", '');
		$this->redirect(array('action' => 'index'));
	}
	
	function forRent()
	{
		$this->Session->write("filter_for", "l");
		$this->redirect(array('action' => 'index'));
	}
	
	function forSale()
	{
		$this->Session->write("filter_for", "s");
		$this->redirect(array('action' => 'index'));
	}
	
	function productsByProject($id = null)
	{
		//Controller::loadModel('Content');
		$this->Session->write("filter_category_id", 0);
		$this->Session->write("filter_for", "0");
		$this->Session->write("filter_bathrooms", 0);
		$this->Session->write("filter_bedrooms", 0);
		$this->Session->write("filter_keyword", '');
		$this->Session->write("filter_product_price", '');
		$this->Session->write("filter_product_area", '');
		
		$project = $this->Product->Project->find("first", array('conditions'=>array('Project.id'=>$id)));
		$this->Session->write("filter_city_id", $project["Project"]["city_id"]);
		$this->Session->write("filter_project_id", $project["Project"]["id"]);
		$this->Session->write("filter_district_id", $project["Project"]["district_id"]);
		$this->redirect(array('action' => 'index'));
	}
	
	function productsByCategory($id = null)
	{
		//Controller::loadModel('Content');
		$this->Session->write("filter_category_id", $id);
		$this->Session->write("filter_for", "0");
		$this->Session->write("filter_bathrooms", 0);
		$this->Session->write("filter_bedrooms", 0);
		$this->Session->write("filter_keyword", '');
		$this->Session->write("filter_product_price", '');
		$this->Session->write("filter_product_area", '');		
		
		$this->Session->write("filter_city_id", 0);
		$this->Session->write("filter_project_id", 0);
		$this->Session->write("filter_district_id", 0);
		$this->redirect(array('action' => 'index'));
	}
	
	function details($id = null)
	{
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		
		
		$user = $this->Auth->user();
		
		
		
		$this->layout = 'home';
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$product = $this->Product->read(null, $id);
		
		//counter
		$product["Product"]["hit"] += 1;
		$this->Product->save($product);
		
		//Price
			Controller::loadModel('Currency');
		if($product["Product"]["price"]) {
			if($product['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($product['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";
			
			//$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
			//if($currency["Currency"]["id"] == 2)
			//	$product["Product"]["price"] = parent::priceFormat(($product["Product"]["price"]*$currency["Currency"]["rate"])/$product["CurrencyPrice"]["rate"]).$cur;
			//else
			//{
			//	$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
			//	$product["Product"]["price"] = number_format(($product["Product"]["price"]*$currency["Currency"]["rate"])/$product["CurrencyPrice"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
			//}
			//use for each product
			$currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
			foreach($currency_list as $item)
			{
				$value = ($product["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $product["CurrencyPrice"]["rate"]);
				
				if($item["Currency"]["id"] == 2)
					$value = parent::priceFormat(($product["Product"]["price"]*$item["Currency"]["rate"])/$product["CurrencyPrice"]["rate"]).$cur;
				else
				{
					$tp = $item["Currency"]["id"] == 3 ? 3 : 0;
					$value = number_format(($product["Product"]["price"]*$item["Currency"]["rate"])/$product["CurrencyPrice"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
				}
				
				$product["prices"][$item['Currency']['id']] = array(
								    'id'=>$item['Currency']['id'],
								    'code'=>$item['Currency']['code'],
								    'value'=>$value
							);
			}
		}
		else
		{
			$product["Product"]["price"] = 0;
		}
			
			
		
		
		//Format number 000.000.000
		//$product["Product"]["price"] = $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",") : "";
		$product["Product"]["property_area"] = $product["Product"]["property_area"] != '' ? number_format($product["Product"]["property_area"],0,".", ",") : "";
		$product["Product"]["lot_area"] = $product["Product"]["lot_area"] != '' ? number_format($product["Product"]["lot_area"],0,".", ",") : "";
		//$product["Product"]["commission"] = $product["Product"]["commission"] != '' ? number_format($product["Product"]["commission"],0,".", ",") : "";
		
		
		
		
		//Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$product["Product"]["id"])));
		
		$slogan = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'3'
							)
						)
					);
                
                //Tin luu trữ
                        $ef = $this->Product->Favorite->find('first', array(
                                                                    'conditions'=>array(
                                                                        'Favorite.user_id'=>$user['User']['id'],
                                                                        'Favorite.product_id'=>$product["Product"]["id"]
                                                                    )   
                                                            ));
                        if($ef)
                        {
                            $product["isFavorite"] = 1;
                            $product["Product"]['Favorite'] = $ef['Favorite'];
                        }
                        else
                        {
                            $product["isFavorite"] = 0;
                        }
                        
                        
		
		$relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$product["Product"]["district_id"],
									'Product.for'=>$product["Product"]["for"],
									'Product.category_id'=>$product["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($product["Product"]["price"]*0.85, $product["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($product["Product"]["lot_area"]*0.8, $product["Product"]["lot_area"]*1.2),
									'published'=>2
								),
								'limit'=>5
							));
		foreach($relatedProducts as $key => $p)
		{
		    $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
		    //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
		    $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
		//    //Price
		//	Controller::loadModel('Currency');
		//	$cur = $p['Product']['price_perm2'] ? "/m2" : "";
		//	$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
		//	if($currency["Currency"]["id"] == 2)
		//		$relatedProducts[$key]["Product"]["price"] = parent::priceFormat($p["Product"]["price"]).$cur;
		//	else
		//	{
		//		$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
		//		$relatedProducts[$key]["Product"]["price"] = number_format($p["Product"]["price"]*$currency["Currency"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
		//	}
		
			if($p["Product"]["price"]) {
				if($p['Product']['price_perm2'] == 1)
					$cur = "/m2";
				else if($p['Product']['price_perm2'] == 2)
					$cur = "/tháng";
				else $cur = "";
			
				$currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
					
					$relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
									    'id'=>$item['Currency']['id'],
									    'code'=>$item['Currency']['code'],
									    'value'=>$value
								);
				}
			}
			else
			{
					$relatedProducts[$key]["Product"]["price"] = 0;
			}	
		    
		}
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($product);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);
		$this->set('relatedProducts', $relatedProducts);
		$this->set('pus', $pus);
	}
	
	
	
	function ajaxMap($id = null)
	{
		$this->layout = null;
		$product = $this->Product->read(null, $id);		
		$this->set('product', $product);		
	}
	
	function quick_add() {
		$this->layout = 'home';
		$type_id = 1;
		$city_id = 1;
		$district_id = 1;
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		//$user = $this->Auth->user();
                
                $this->Session->write("new_register", "0");
		//$this->Session->delete("temp_images");
		
		$utilities = $this->Utility->find('all');
		$uti_array = array();
		
		//var_dump($this->data);
		
		if (!empty($this->data)) {
			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			//$this->data["Product"]["user_id"] = $user["User"]["id"];
			$this->data["Product"]["published"] = 0;
                        
                        if(isset($this->params['form']['postnew']))
                        {
                            $this->data["Product"]["published"] = 1;
                        }
			
			
			
			if($this->data["Product"]["type_id"] == 3)
			{
				$this->data["Product"]["property_area"] = 0;
				$this->data["Product"]["bedrooms"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
				$this->data["Product"]["floors"] = 0;
			}
			else if($this->data["Product"]["type_id"] == 2)
			{
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
			}
			//echo $this->data["Product"]["commission"]."sdfdsdfsdf";
			
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			//var_dump($this->data);		
			//var_dump($this->data["ProductsUtility"]);
			$this->Product->create();
			if(!isset($this->params['form']['preview']) && !isset($this->params['form']['upload'])) {				

				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('Sản phẩm đã được thêm thành công', true));
					
					//save images
					foreach($this->data["ProductImage"] as $item)
					{
						if($item["filename"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $this->data["Product"]["name"];
							$image["ProductImage"]["product_id"] = $this->Product->id;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								//$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
							} else {
								//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
							}
						}
					}
					
					//save temp images
					$images_array = $this->Session->read('temp_images');
					$images = array();
					if(count($images_array))
					{
						if($this->Product->ProductImage->updateAll(array('ProductImage.product_id'=>$this->Product->id,'ProductImage.title'=>"'".$this->data["Product"]["name"]."'"), array('ProductImage.id'=>$images_array)))
						{
							$this->Session->delete("temp_images");
						}
						
					}
					
					
					//save attributes
					//var_dump($this->data["ProductsUtility"]);
									
					
					foreach($utilities as $item)
					{
						$pu["ProductsUtility"]["product_id"] = $this->Product->id;
						$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
					
						if(in_array($item["Utility"]["id"], $uti_array))
						{						
							$pu["ProductsUtility"]["value"] = 1;
						}
						else
						{
							$pu["ProductsUtility"]["value"] = 0;
						}
						
						$this->ProductsUtility->create();
						if ($this->ProductsUtility->save($pu["ProductsUtility"])) {
							$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
					
					
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin sản phẩm.', true));
				}
			}
                        else if(isset($this->params['form']['preview']))
                        {
                            $this->layout = 'home';
                            //Controller::loadModel('UserProfile');
                            
                            //$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
                            
                            
                            /////
                            $relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$this->data["Product"]["district_id"],
									'Product.for'=>$this->data["Product"]["for"],
									'Product.category_id'=>$this->data["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($this->data["Product"]["price"]*0.85, $this->data["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($this->data["Product"]["lot_area"]*0.8, $this->data["Product"]["lot_area"]*1.2),
									'published'=>1
								),
								'limit'=>5
							));
                            foreach($relatedProducts as $key => $p)
                            {
                                $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
                                //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
                                $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
                                                                                                                         'city'=>strtolower(Inflector::slug($p["City"]["name"])),
                                                                                                                         'id'=>$p["Product"]["id"],
                                                                                                                         'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
                            
                            
                                    if($p["Product"]["price"]) {
                                            if($p['Product']['price_perm2'] == 1)
                                                    $cur = "/m2";
                                            else if($p['Product']['price_perm2'] == 2)
                                                    $cur = "/tháng";
                                            else $cur = "";
                                    
                                            $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
                                                    
                                                    $relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
                                                                                        'id'=>$item['Currency']['id'],
                                                                                        'code'=>$item['Currency']['code'],
                                                                                        'value'=>$value
                                                                            );
                                            }
                                    }
                                    else
                                    {
                                                    $relatedProducts[$key]["Product"]["price"] = 0;
                                    }	
                                
                            }
                            
                            
                            /////
                            $this->data["Product"]["create_date"] = date('Y-m-d H:i');
                            
                            ////////
                            if($this->data["Product"]["price"]) {
                                    if($this->data['Product']['price_perm2'] == 1)
                                            $cur = "/m2";
                                    else if($this->data['Product']['price_perm2'] == 2)
                                            $cur = "/tháng";
                                    else $cur = "";
                                    
                                    
                                    $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
                                    $rate = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Product"]['price_currency'])));
                                    foreach($currency_list as $item)
                                    {
                                            $value = ($this->data["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $rate["Currency"]["rate"]);
                                            
                                            if($item["Currency"]["id"] == 2)
                                                    $value = parent::priceFormat(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"]).$cur;
                                            else
                                            {
                                                    $tp = $item["Currency"]["id"] == 3 ? 3 : 0;
                                                    $value = number_format(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
                                            }
                                            
                                            $this->data["prices"][$item['Currency']['id']] = array(
                                                                                'id'=>$item['Currency']['id'],
                                                                                'code'=>$item['Currency']['code'],
                                                                                'value'=>$value
                                                                    );
                                    }
                            }
                            else
                            {
                                    $this->data["Product"]["price"] = 0;
                            }
                            
                            //Type
                            $rec = $this->Product->Type->find('first', array('conditions'=>array('Type.id'=>$this->data["Product"]['type_id'])));
                            $this->data['Type'] = $rec['Type'];
                            
                            //City
                            $rec = $this->Product->City->find('first', array('conditions'=>array('City.id'=>$this->data["Product"]['city_id'])));
                            $this->data['City'] = $rec['City'];
                            //District
                            $rec = $this->Product->District->find('first', array('conditions'=>array('District.id'=>$this->data["Product"]['district_id'])));
                            $this->data['District'] = $rec['District'];
                            //Ward
                            $rec = $this->Product->Ward->find('first', array('conditions'=>array('Ward.id'=>$this->data["Product"]['ward_id'])));
                            $this->data['Ward'] = $rec['Ward'];
                            //Street
                            $rec = $this->Product->Street->find('first', array('conditions'=>array('Street.id'=>$this->data["Product"]['street_id'])));
                            $this->data['Street'] = $rec['Street'];
                            //Project
                            $rec = $this->Product->Project->find('first', array('conditions'=>array('Project.id'=>$this->data["Product"]['project_id'])));
                            $this->data['Project'] = $rec['Project'];                            
                             //Certificate  
                            $rec = $this->Product->Certificate->find('first', array('conditions'=>array('Certificate.id'=>$this->data["Product"]['certificate_id'])));
                            $this->data['Certificate'] = $rec['Certificate'];
                            
                            ///
                            $this->data["Product"]["ncreate_date"] = $this->data["Product"]["create_date"];
                            $this->data["Product"]["create_date"] = parent::dateFormat($this->data["Product"]["create_date"]);
                            
                            //
                            $cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
                            
                            $uti_array = array();
                            if(isset($this->data["ProductsUtility"]))
                                foreach($this->data["ProductsUtility"] as $item)
                                {
                                            $uti_array[] = $item["id"];					
                                }
                            $this->Session->setFlash(__('Đây là trang minh họa cho sản phẩm BĐS, nội dung chỉ đê tham khảo.', true));
                            $this->set('product', $this->data);
                            $this->set('profile', $profile);
                            $this->set('relatedProducts', $relatedProducts);
                            $this->set('cat', $cat);
                            $this->set('uti_array', $uti_array);
			    
			    //temp images
				$images_array = $this->Session->read('temp_images');
				$images = array();
				if(count($images_array))
				{
					$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
				}
				$this->set('images', $images);
			    
                            $this->render('details_preview');
                        }
			else if(isset($this->params['form']['upload']))
                        {
					//save images
					//$this->Session->write('temp_image_', $this->Product->ProductImage->id);
					foreach($this->data["ProductImage"] as $key => $item)
					{
						//var_dump($item["filename"]["name"]);
						if($item["filename"]["name"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = "temp";
							$image["ProductImage"]["product_id"] = -1;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								$this->Session->setFlash(__('Ảnh đã được tải thành công.', true));
								$count_image = count($this->Session->read('temp_images'));
								$this->Session->write('temp_images.'.$count_image, $this->Product->ProductImage->id);
								//$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('Lỗi khi tải ảnh, vui lòng kiểm tra thông tin yêu cầu.', true));
							}
						}
					}
			}
			
			//Filter type city district
			$type_id = $this->data["Product"]["type_id"];
			$city_id = $this->data["Product"]["city_id"];
			$cat_id = $this->data["Product"]["category_id"];
			$district_id = $this->data["Product"]["district_id"];
			
			$this->data["Product"]["price"] = $this->data["Product"]["price"] != '' ? number_format($this->data["Product"]["price"],0,".", ",") : "";
			$this->data["Product"]["property_area"] = $this->data["Product"]["property_area"] != '' ? number_format($this->data["Product"]["property_area"],0,".", ",") : "";
			$this->data["Product"]["lot_area"] = $this->data["Product"]["lot_area"] != '' ? number_format($this->data["Product"]["lot_area"],0,".", ",") : "";
			$this->data["Product"]["commission"] = $this->data["Product"]["commission"] != '' ? number_format($this->data["Product"]["commission"],0,".", ",") : "";
			
		}
		//var_dump($this->data);
		//temp images
		$images_array = $this->Session->read('temp_images');
		$images = array();
		if(count($images_array))
		{
			$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
		}
		
		
		
		$types = $this->Product->Type->find('list');
		$categories = $this->Product->Category->find('list', array("conditions"=>array("type_id"=>$type_id)));
		
		$cats = $this->Product->Category->find('all', array("conditions"=>array("type_id"=>$type_id)));
		if(isset($this->data["Product"]["category_id"]))
			$cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
		else
			$cat = $this->Product->Category->read(null, $cats[0]["Category"]["id"]);
		//var_dump($cat);
		
		$cities = $this->Product->City->find('list');
		$this->data["Product"]["city_id"] = $city_id;
		$dits = $this->Product->District->find('list', array("conditions"=>array("city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
                
                //wards
                $wards[0] = "- ".__('Phường/Xã', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $ws = $this->Product->Ward->find('list', array("conditions"=>array("Ward.district_id"=>$this->data["Product"]["district_id"])));
                    foreach($ws as $key => $value)
                    {
                            $wards[$key] = $value;
                    }
                }
                
                //streets
                $streets[0] = "- ".__('Tên đường', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $strts = $this->Product->Street->find("all");		
                    foreach($strts as $kk => $item)
                    {
                            $ok = false;		
                            if(isset($item['DistrictsStreet']))
                            {
                                    
                                    foreach($item['DistrictsStreet'] as $dt)
                                    {					
                                            if($dt['district_id'] == $this->data["Product"]["district_id"])
                                            {
                                                    $ok = true;
                                                    break;						
                                            }					
                                    }
                            }
                            if(!$ok)
                            {
                                    unset($strts[$kk]);
                            }
                    }
                    foreach($strts as $key => $value)
                    {
                            $streets[$value['Street']['id']] = $value['Street']['name'];
                    }
                }
                
                
		$pros = $this->Product->Project->find('list', array("conditions"=>array("district_id"=>$district_id)));

		$projects[0] = "- ".__('khác', true)." -";
		foreach($pros as $key => $value)
		{
			$projects[$key] = $value;
		}
		$occupantTypes = $this->Product->OccupantType->find('list');
		$certificates = $this->Product->Certificate->find('list');
		$users = $this->Product->User->find('list');
		$currencies = $this->Product->CurrencyPrice->find('all', array('order'=>'CurrencyPrice.order'));
		//var_dump($this->data);
		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets', 'images'));		
	}
	

	function admin_index() {
		$this->Product->recursive = 0;
		
		//Get all filters
		$conditions = array();
		
		//filter category
		//$cat_id = !empty($this->params['form']['filter_category_id']) ? $this->params['form']['filter_category_id'] : 0;
		if(!empty($this->params['form']['filter_category_id']) || (isset($this->params['form']['filter_category_id']) && $this->params['form']['filter_category_id'] == 0))
		{
			$cat_id = $this->params['form']['filter_category_id'];
		}
		else
			$cat_id = $this->Session->read("filter_category_id");
		//echo $cat_id."ooo";	
		$this->Session->write("filter_category_id", $cat_id);
		
		
		$cats = $this->Product->Category->find('all');
		$cat = "";
		if($cat_id)
		{
			$conditions["Product.category_id"] = $cat_id;
			$cat = $this->Product->Category->find('first',array('conditions'=>array('Category.id'=>$cat_id)));
		}
		
		//filter for
		//$for = !empty($this->params['form']['filter_for']) ? $this->params['form']['filter_for'] : '0';
		if(!empty($this->params['form']['filter_for']) || (isset($this->params['form']['filter_for']) && $this->params['form']['filter_for'] == 0))
		{
			$for = $this->params['form']['filter_for'];
		}
		else
			$for = $this->Session->read("filter_for");
		//echo $cat_id."ooo";	
		$this->Session->write("filter_for", $for);
		
		if($for)
		{
			$conditions["Product.for"] = $for;				
		}
		
		
		//filter module		
		if(!empty($this->params['form']['filter_module']) || (isset($this->params['form']['filter_module']) && $this->params['form']['filter_module'] == 0))
		{
			$module = $this->params['form']['filter_module'];
		}
		else
			$module = $this->Session->read("filter_module");
		//echo $for."ooo";	
		$this->Session->write("filter_module", $module);
		if($module)
		{
			$conditions["Product.".$module] = 1;				
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
			$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			$projects = array();
		}
		else
		{
			$districts = array();
			$projects = array();
		}
		
		//filter project		
		if(!empty($this->params['form']['filter_district_id']) || (isset($this->params['form']['filter_district_id']) && $this->params['form']['filter_district_id'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id'];
		}
		else
			$district_id = $this->Session->read("filter_district_id");
		$this->Session->write("filter_district_id", $district_id);
		
		$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
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
		}
		
		//filter project		
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
			$conditions["Product.name LIKE ?"] = '%'.$keyword.'%';			
			//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		}
		
		//filter product price		
		if(!empty($this->params['form']['filter_product_price']) || (isset($this->params['form']['filter_product_price']) && $this->params['form']['filter_product_price'] == ''))
		{
			$price_range = $this->params['form']['filter_product_price'];
		}
		else
			$price_range = $this->Session->read("filter_product_price");
		$this->Session->write("filter_product_price", $price_range);
		
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
		
		
		//filter product published		
		if(!empty($this->params['form']['filter_published']) || (isset($this->params['form']['filter_published']) && $this->params['form']['filter_published'] == 0))
		{
			$published = $this->params['form']['filter_published'];
		}
		else
			$published = $this->Session->read("filter_published");
		
		$this->Session->write("filter_published", $published);
		
		if($published != '' && $published != 'all')
		{
			$conditions["Product.published"] = $published;
		}
		
		//count bds
		$count = array();
                $count[-2] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'-2')));
		$count[-1] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'-1')));
		$count[0] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'0')));
		$count[1] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'1')));
		$count[2] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'2')));
                $count[3] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'3')));
		
		
		$this->paginate = array('conditions'=>$conditions);
		$products = $this->paginate();
		
		
		foreach($products as $key => $p)
		{
			$image = $this->Product->ProductImage->find('first', array(
									'conditions'=>array(
										'ProductImage.product_id'=>$p["Product"]["id"]
									)
								));
			$products[$key]['ProductImage'] = $image["ProductImage"];
		}
		//var_dump($products);
		
		//filter 
		$cities = $this->Product->City->find('all');
		//$districts = $this->Product->District->find('all');
		//$projects = $this->Product->Project->find('all');
		
		$this->set('products', $products);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);
		$this->set('districts', $districts);
		$this->set('district_id', $district_id);
		$this->set('projects', $projects);
		$this->set('project_id', $project_id);
		$this->set('keyword', $keyword);
		$this->set('price_range', $price_range);
		$this->set('area_range', $area_range);
		$this->set('cats', $cats);
		$this->set('cat_id', $cat_id);
		$this->set('for', $for);
		$this->set('bedrooms', $bedrooms);
		$this->set('bathrooms', $bathrooms);
		$this->set('module', $module);
		$this->set('published', $published);
		$this->set('count', $count);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$product = $this->Product->read(null, $id);
		
		//Format number 000.000.000
			$product["Product"]["price"] = $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",") : "";
			$product["Product"]["property_area"] = $product["Product"]["property_area"] != '' ? number_format($product["Product"]["property_area"],0,".", ",") : "";
			$product["Product"]["lot_area"] = $product["Product"]["lot_area"] != '' ? number_format($product["Product"]["lot_area"],0,".", ",") : "";
			$product["Product"]["commission"] = $product["Product"]["commission"] != '' ? number_format($product["Product"]["commission"],0,".", ",") : "";
		
		//Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$product["Product"]["id"])));
		
		$this->set('product', $product);
		$this->set('images', $images);
	}

	function admin_add() {
		$type_id = 1;
		$city_id = 1;
		$district_id = 1;
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		$user = $this->Auth->user();
                
                $this->Session->write("new_register", "0");
		//$this->Session->delete("temp_images");
		
		$utilities = $this->Utility->find('all');
		$uti_array = array();
		
		//var_dump($this->data);
		
		if (!empty($this->data)) {
			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			$this->data["Product"]["user_id"] = $user["User"]["id"];
			$this->data["Product"]["published"] = 0;
                        
                        if(isset($this->params['form']['postnew']))
                        {
                            $this->data["Product"]["published"] = 1;
                        }
			
			
			
			if($this->data["Product"]["type_id"] == 3)
			{
				$this->data["Product"]["property_area"] = 0;
				$this->data["Product"]["bedrooms"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
				$this->data["Product"]["floors"] = 0;
			}
			else if($this->data["Product"]["type_id"] == 2)
			{
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
			}
			//echo $this->data["Product"]["commission"]."sdfdsdfsdf";
			
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			//var_dump($this->data);		
			//var_dump($this->data["ProductsUtility"]);
			
			if(!isset($this->params['form']['preview']) && !isset($this->params['form']['upload'])) {				
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('Sản phẩm đã được thêm thành công', true));
					
					//save images
					foreach($this->data["ProductImage"] as $item)
					{
						if($item["filename"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $this->data["Product"]["name"];
							$image["ProductImage"]["product_id"] = $this->Product->id;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								//$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
							} else {
								//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
							}
						}
					}
					
					//save temp images
					$images_array = $this->Session->read('temp_images');
					$images = array();
					if(count($images_array))
					{
						if($this->Product->ProductImage->updateAll(array('ProductImage.product_id'=>$this->Product->id,'ProductImage.title'=>"'".$this->data["Product"]["name"]."'"), array('ProductImage.id'=>$images_array)))
						{
							$this->Session->delete("temp_images");
						}
						
					}
					
					
					//save attributes
					//var_dump($this->data["ProductsUtility"]);
									
					
					foreach($utilities as $item)
					{
						$pu["ProductsUtility"]["product_id"] = $this->Product->id;
						$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
					
						if(in_array($item["Utility"]["id"], $uti_array))
						{						
							$pu["ProductsUtility"]["value"] = 1;
						}
						else
						{
							$pu["ProductsUtility"]["value"] = 0;
						}
						
						$this->ProductsUtility->create();
						if ($this->ProductsUtility->save($pu["ProductsUtility"])) {
							$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
					
					
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin sản phẩm.', true));
				}
			}
                        else if(isset($this->params['form']['preview']))
                        {
                            $this->layout = 'home';
                            Controller::loadModel('UserProfile');
                            
                            $profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
                            
                            
                            /////
                            $relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$this->data["Product"]["district_id"],
									'Product.for'=>$this->data["Product"]["for"],
									'Product.category_id'=>$this->data["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($this->data["Product"]["price"]*0.85, $this->data["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($this->data["Product"]["lot_area"]*0.8, $this->data["Product"]["lot_area"]*1.2),
									'published'=>1
								),
								'limit'=>5
							));
                            foreach($relatedProducts as $key => $p)
                            {
                                $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
                                //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
                                $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
                                                                                                                         'city'=>strtolower(Inflector::slug($p["City"]["name"])),
                                                                                                                         'id'=>$p["Product"]["id"],
                                                                                                                         'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
                            
                            
                                    if($p["Product"]["price"]) {
                                            if($p['Product']['price_perm2'] == 1)
                                                    $cur = "/m2";
                                            else if($p['Product']['price_perm2'] == 2)
                                                    $cur = "/tháng";
                                            else $cur = "";
                                    
                                            $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
                                                    
                                                    $relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
                                                                                        'id'=>$item['Currency']['id'],
                                                                                        'code'=>$item['Currency']['code'],
                                                                                        'value'=>$value
                                                                            );
                                            }
                                    }
                                    else
                                    {
                                                    $relatedProducts[$key]["Product"]["price"] = 0;
                                    }	
                                
                            }
                            
                            
                            /////
                            $this->data["Product"]["create_date"] = date('Y-m-d H:i');
                            
                            ////////
                            if($this->data["Product"]["price"]) {
                                    if($this->data['Product']['price_perm2'] == 1)
                                            $cur = "/m2";
                                    else if($this->data['Product']['price_perm2'] == 2)
                                            $cur = "/tháng";
                                    else $cur = "";
                                    
                                    
                                    $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
                                    $rate = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Product"]['price_currency'])));
                                    foreach($currency_list as $item)
                                    {
                                            $value = ($this->data["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $rate["Currency"]["rate"]);
                                            
                                            if($item["Currency"]["id"] == 2)
                                                    $value = parent::priceFormat(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"]).$cur;
                                            else
                                            {
                                                    $tp = $item["Currency"]["id"] == 3 ? 3 : 0;
                                                    $value = number_format(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
                                            }
                                            
                                            $this->data["prices"][$item['Currency']['id']] = array(
                                                                                'id'=>$item['Currency']['id'],
                                                                                'code'=>$item['Currency']['code'],
                                                                                'value'=>$value
                                                                    );
                                    }
                            }
                            else
                            {
                                    $this->data["Product"]["price"] = 0;
                            }
                            
                            //Type
                            $rec = $this->Product->Type->find('first', array('conditions'=>array('Type.id'=>$this->data["Product"]['type_id'])));
                            $this->data['Type'] = $rec['Type'];
                            
                            //City
                            $rec = $this->Product->City->find('first', array('conditions'=>array('City.id'=>$this->data["Product"]['city_id'])));
                            $this->data['City'] = $rec['City'];
                            //District
                            $rec = $this->Product->District->find('first', array('conditions'=>array('District.id'=>$this->data["Product"]['district_id'])));
                            $this->data['District'] = $rec['District'];
                            //Ward
                            $rec = $this->Product->Ward->find('first', array('conditions'=>array('Ward.id'=>$this->data["Product"]['ward_id'])));
                            $this->data['Ward'] = $rec['Ward'];
                            //Street
                            $rec = $this->Product->Street->find('first', array('conditions'=>array('Street.id'=>$this->data["Product"]['street_id'])));
                            $this->data['Street'] = $rec['Street'];
                            //Project
                            $rec = $this->Product->Project->find('first', array('conditions'=>array('Project.id'=>$this->data["Product"]['project_id'])));
                            $this->data['Project'] = $rec['Project'];                            
                             //Certificate  
                            $rec = $this->Product->Certificate->find('first', array('conditions'=>array('Certificate.id'=>$this->data["Product"]['certificate_id'])));
                            $this->data['Certificate'] = $rec['Certificate'];
                            
                            ///
                            $this->data["Product"]["ncreate_date"] = $this->data["Product"]["create_date"];
                            $this->data["Product"]["create_date"] = parent::dateFormat($this->data["Product"]["create_date"]);
                            
                            //
                            $cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
                            
                            $uti_array = array();
                            if(isset($this->data["ProductsUtility"]))
                                foreach($this->data["ProductsUtility"] as $item)
                                {
                                            $uti_array[] = $item["id"];					
                                }
                            $this->Session->setFlash(__('Đây là trang minh họa cho sản phẩm BĐS, nội dung chỉ đê tham khảo.', true));
                            $this->set('product', $this->data);
                            $this->set('profile', $profile);
                            $this->set('relatedProducts', $relatedProducts);
                            $this->set('cat', $cat);
                            $this->set('uti_array', $uti_array);
			    
			    //temp images
				$images_array = $this->Session->read('temp_images');
				$images = array();
				if(count($images_array))
				{
					$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
				}
				$this->set('images', $images);
			    
                            $this->render('details_preview');
                        }
			else if(isset($this->params['form']['upload']))
                        {
					//save images
					//$this->Session->write('temp_image_', $this->Product->ProductImage->id);
					foreach($this->data["ProductImage"] as $key => $item)
					{
						//var_dump($item["filename"]["name"]);
						if($item["filename"]["name"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = "temp";
							$image["ProductImage"]["product_id"] = -1;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								$this->Session->setFlash(__('Ảnh đã được tải thành công.', true));
								$count_image = count($this->Session->read('temp_images'));
								$this->Session->write('temp_images.'.$count_image, $this->Product->ProductImage->id);
								//$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('Lỗi khi tải ảnh, vui lòng kiểm tra thông tin yêu cầu.', true));
							}
						}
					}
			}
			
			//Filter type city district
			$type_id = $this->data["Product"]["type_id"];
			$city_id = $this->data["Product"]["city_id"];
			$cat_id = $this->data["Product"]["category_id"];
			$district_id = $this->data["Product"]["district_id"];
			
			$this->data["Product"]["price"] = $this->data["Product"]["price"] != '' ? number_format($this->data["Product"]["price"],0,".", ",") : "";
			$this->data["Product"]["property_area"] = $this->data["Product"]["property_area"] != '' ? number_format($this->data["Product"]["property_area"],0,".", ",") : "";
			$this->data["Product"]["lot_area"] = $this->data["Product"]["lot_area"] != '' ? number_format($this->data["Product"]["lot_area"],0,".", ",") : "";
			$this->data["Product"]["commission"] = $this->data["Product"]["commission"] != '' ? number_format($this->data["Product"]["commission"],0,".", ",") : "";
			
		}
		//var_dump($this->data);
		//temp images
		$images_array = $this->Session->read('temp_images');
		$images = array();
		if(count($images_array))
		{
			$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
		}
		
		
		
		$types = $this->Product->Type->find('list');
		$categories = $this->Product->Category->find('list', array("conditions"=>array("type_id"=>$type_id)));
		
		$cats = $this->Product->Category->find('all', array("conditions"=>array("type_id"=>$type_id)));
		if(isset($this->data["Product"]["category_id"]))
			$cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
		else
			$cat = $this->Product->Category->read(null, $cats[0]["Category"]["id"]);
		//var_dump($cat);
		
		$cities = $this->Product->City->find('list');
		$this->data["Product"]["city_id"] = $city_id;
		$dits = $this->Product->District->find('list', array("conditions"=>array("city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
                
                //wards
                $wards[0] = "- ".__('Phường/Xã', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $ws = $this->Product->Ward->find('list', array("conditions"=>array("Ward.district_id"=>$this->data["Product"]["district_id"])));
                    foreach($ws as $key => $value)
                    {
                            $wards[$key] = $value;
                    }
                }
                
                //streets
                $streets[0] = "- ".__('Tên đường', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $strts = $this->Product->Street->find("all");		
                    foreach($strts as $kk => $item)
                    {
                            $ok = false;		
                            if(isset($item['DistrictsStreet']))
                            {
                                    
                                    foreach($item['DistrictsStreet'] as $dt)
                                    {					
                                            if($dt['district_id'] == $this->data["Product"]["district_id"])
                                            {
                                                    $ok = true;
                                                    break;						
                                            }					
                                    }
                            }
                            if(!$ok)
                            {
                                    unset($strts[$kk]);
                            }
                    }
                    foreach($strts as $key => $value)
                    {
                            $streets[$value['Street']['id']] = $value['Street']['name'];
                    }
                }
                
                
		$pros = $this->Product->Project->find('list', array("conditions"=>array("district_id"=>$district_id)));

		$projects[0] = "- ".__('khác', true)." -";
		foreach($pros as $key => $value)
		{
			$projects[$key] = $value;
		}
		$occupantTypes = $this->Product->OccupantType->find('list');
		$certificates = $this->Product->Certificate->find('list');
		$users = $this->Product->User->find('list');
		$currencies = $this->Product->CurrencyPrice->find('all', array('order'=>'CurrencyPrice.order'));
		//var_dump($this->data);
		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets', 'images'));		
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//check if user has role on this product
			//$user = $this->Auth->user();		
			//if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			//{
			//	$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
			//	$this->redirect(array('action' => 'index'));
			//	//echo "sfsdfsdfsdfs";
			//}
		
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		$uti_array = array();
		$utilities = $this->Utility->find('all');
		
		if (!empty($this->data)) {
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			
			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			//$this->data["Product"]["user_id"] = $user["User"]["id"];
                        
                        //if(isset($this->params['form']['postnew']))
                        //{
                        //    $this->data["Product"]["published"] = 1;
                        //}
			
			
			
			if($this->data["Product"]["type_id"] == 3)
			{
				$this->data["Product"]["property_area"] = 0;
				$this->data["Product"]["bedrooms"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
				$this->data["Product"]["floors"] = 0;
			}
			
			if($this->data["Product"]["type_id"] == 2)
			{
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
				$this->data["Product"]["build_area"] = 0;
			}
			
			//var_dump($this->data["ProductImage"])."kreuhkjerthe";
			if(!isset($this->params['form']['preview']) && !isset($this->params['form']['upload'])) {
                            if ($this->Product->save($this->data)) {
                                    $this->Session->setFlash(__('Sản phẩm đã được lưu thành công', true));
                                    
                                    //save images
                                    foreach($this->data["ProductImage"] as $item)
                                    {
                                            if($item["filename"] != "")
                                            {
                                                    $image["ProductImage"] = $item;
                                                    $image["ProductImage"]["title"] = $this->data["Product"]["name"];
                                                    $image["ProductImage"]["product_id"] = $this->Product->id;
                                                    
                                                    $this->Product->ProductImage->create();
                                                    if ($this->Product->ProductImage->save($image["ProductImage"])) {
                                                            $this->Session->setFlash(__('Sản phẩm đã được lưu thành công.', true));
                                                            //$this->redirect(array('action' => 'index'));
                                                    } else {
                                                            //$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
                                                    }
                                            }
                                    }
                                    
                                    //save attributes
                                    //var_dump($this->data["ProductsUtility"]);				
                                    foreach($utilities as $item)
                                    {
                                            //$pu["ProductsUtility"]["product_id"] = $this->Product->id;
                                            //$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
                                            
                                            $pu = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$this->data["Product"]["id"],
                                                                                                                  "ProductsUtility.utility_id"=>$item["Utility"]["id"])));
                                            
                                            if(!$pu)
                                            {
                                                    $pu["ProductsUtility"]["product_id"] = $this->data["Product"]["id"];
                                                    $pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
                                                    $this->ProductsUtility->create();
                                            }
                                            //var_dump($pu);
                                            if(in_array($item["Utility"]["id"], $uti_array))
                                            {						
                                                    $pu["ProductsUtility"]["value"] = 1;
                                            }
                                            else
                                            {
                                                    $pu["ProductsUtility"]["value"] = 0;
                                            }
                                            
                                            
                                            //var_dump($pu);
                                            if ($this->ProductsUtility->save($pu["ProductsUtility"])) {
                                                    $this->Session->setFlash(__('Sản phẩm đã được lưu thành công.', true));
                                                            //$this->redirect(array('action' => 'index'));
                                            } else {
                                                    $this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
                                            }
                                    }
                                    
                                    
                                    
                                    $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin sản phẩm.', true));
                            }
                        }
                        else if(isset($this->params['form']['preview']))
                        {
                            $this->layout = 'home';
                            Controller::loadModel('UserProfile');
                            
                            $profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
                            
                            
                            /////
                            $relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$this->data["Product"]["district_id"],
									'Product.for'=>$this->data["Product"]["for"],
									'Product.category_id'=>$this->data["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($this->data["Product"]["price"]*0.85, $this->data["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($this->data["Product"]["lot_area"]*0.8, $this->data["Product"]["lot_area"]*1.2),
									'published'=>1
								),
								'limit'=>5
							));
                            foreach($relatedProducts as $key => $p)
                            {
                                $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
                                //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
                                $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
                                                                                                                         'city'=>strtolower(Inflector::slug($p["City"]["name"])),
                                                                                                                         'id'=>$p["Product"]["id"],
                                                                                                                         'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
                            
                            
                                    if($p["Product"]["price"]) {
                                            if($p['Product']['price_perm2'] == 1)
                                                    $cur = "/m2";
                                            else if($p['Product']['price_perm2'] == 2)
                                                    $cur = "/tháng";
                                            else $cur = "";
                                    
                                            $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
                                                    
                                                    $relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
                                                                                        'id'=>$item['Currency']['id'],
                                                                                        'code'=>$item['Currency']['code'],
                                                                                        'value'=>$value
                                                                            );
                                            }
                                    }
                                    else
                                    {
                                                    $relatedProducts[$key]["Product"]["price"] = 0;
                                    }	
                                
                            }
                            
                            
                            /////
                            $this->data["Product"]["create_date"] = date('Y-m-d H:i');
                            
                            ////////
                            if($this->data["Product"]["price"]) {
                                    if($this->data['Product']['price_perm2'] == 1)
                                            $cur = "/m2";
                                    else if($this->data['Product']['price_perm2'] == 2)
                                            $cur = "/tháng";
                                    else $cur = "";
                                    
                                    
                                    $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
                                    $rate = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Product"]['price_currency'])));
                                    foreach($currency_list as $item)
                                    {
                                            $value = ($this->data["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $rate["Currency"]["rate"]);
                                            
                                            if($item["Currency"]["id"] == 2)
                                                    $value = parent::priceFormat(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"]).$cur;
                                            else
                                            {
                                                    $tp = $item["Currency"]["id"] == 3 ? 3 : 0;
                                                    $value = number_format(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
                                            }
                                            
                                            $this->data["prices"][$item['Currency']['id']] = array(
                                                                                'id'=>$item['Currency']['id'],
                                                                                'code'=>$item['Currency']['code'],
                                                                                'value'=>$value
                                                                    );
                                    }
                            }
                            else
                            {
                                    $this->data["Product"]["price"] = 0;
                            }
                            
                            //Type
                            $rec = $this->Product->Type->find('first', array('conditions'=>array('Type.id'=>$this->data["Product"]['type_id'])));
                            $this->data['Type'] = $rec['Type'];
                            
                            //City
                            $rec = $this->Product->City->find('first', array('conditions'=>array('City.id'=>$this->data["Product"]['city_id'])));
                            $this->data['City'] = $rec['City'];
                            //District
                            $rec = $this->Product->District->find('first', array('conditions'=>array('District.id'=>$this->data["Product"]['district_id'])));
                            $this->data['District'] = $rec['District'];
                            //Ward
                            $rec = $this->Product->Ward->find('first', array('conditions'=>array('Ward.id'=>$this->data["Product"]['ward_id'])));
                            $this->data['Ward'] = $rec['Ward'];
                            //Street
                            $rec = $this->Product->Street->find('first', array('conditions'=>array('Street.id'=>$this->data["Product"]['street_id'])));
                            $this->data['Street'] = $rec['Street'];
                            //Project
                            $rec = $this->Product->Project->find('first', array('conditions'=>array('Project.id'=>$this->data["Product"]['project_id'])));
                            $this->data['Project'] = $rec['Project'];                            
                             //Certificate  
                            $rec = $this->Product->Certificate->find('first', array('conditions'=>array('Certificate.id'=>$this->data["Product"]['certificate_id'])));
                            $this->data['Certificate'] = $rec['Certificate'];
                            
                            ///
                            $this->data["Product"]["ncreate_date"] = $this->data["Product"]["create_date"];
                            $this->data["Product"]["create_date"] = parent::dateFormat($this->data["Product"]["create_date"]);
                            
                            //
                            $cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
                            
                            $uti_array = array();
                            if(isset($this->data["ProductsUtility"]))
                                foreach($this->data["ProductsUtility"] as $item)
                                {
                                            $uti_array[] = $item["id"];					
                                }
                            $this->Session->setFlash(__('Đây là trang minh họa cho sản phẩm BĐS, nội dung chỉ đê tham khảo.', true));
                            $this->set('product', $this->data);
                            $this->set('profile', $profile);
                            $this->set('relatedProducts', $relatedProducts);
                            $this->set('cat', $cat);
                            $this->set('uti_array', $uti_array);
			    
			    //Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->data["Product"]["id"])));
				$this->set('images', $images);
			    
                            $this->render('details_preview');
                        }
			else if(isset($this->params['form']['upload']))
			{
				//save images
					//$this->Session->write('temp_image_', $this->Product->ProductImage->id);
					foreach($this->data["ProductImage"] as $key => $item)
					{
						//var_dump($item["filename"]["name"]);
						if($item["filename"]["name"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $this->data['Product']['name'];
							$image["ProductImage"]["product_id"] = $this->data['Product']['id'];;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								$this->Session->setFlash(__('Ảnh đã được tải thành công.', true));
								//$count_image = count($this->Session->read('temp_images'));
								//$this->Session->write('temp_images.'.$count_image, $this->Product->ProductImage->id);
								//$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('Lỗi khi tải ảnh, vui lòng kiểm tra thông tin yêu cầu.', true));
							}
						}
					}
			}
			
			
		}
		if (empty($this->data)) {			
			$this->data = $this->Product->read(null, $id);
			
			$uti_array = array();
			foreach($utilities as $item)
			{
					//$pu["ProductsUtility"]["product_id"] = $this->Product->id;
					//$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];					
				$pu = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$this->data["Product"]["id"], "ProductsUtility.utility_id"=>$item["Utility"]["id"])));
				if($pu["ProductsUtility"]["value"] == 1)
					$uti_array[] = $pu["ProductsUtility"]["utility_id"];
			}
		}
		
		
		//Format number 000.000.000
			$this->data["Product"]["price"] = $this->data["Product"]["price"] != '' ? number_format($this->data["Product"]["price"],0,".", ",") : "";
			$this->data["Product"]["property_area"] = $this->data["Product"]["property_area"] != '' ? number_format($this->data["Product"]["property_area"],0,".", ",") : "";
			$this->data["Product"]["lot_area"] = $this->data["Product"]["lot_area"] != '' ? number_format($this->data["Product"]["lot_area"],0,".", ",") : "";
			//$this->data["Product"]["commission"] = $this->data["Product"]["commission"] != '' ? number_format($this->data["Product"]["commission"],0,".", ",") : "";
		
		
		$types = $this->Product->Type->find('list');
		$categories = $this->Product->Category->find('list', array("conditions"=>array("type_id"=>$this->data["Product"]["type_id"])));
		$cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
		$cities = $this->Product->City->find('list');
		$dits = $this->Product->District->find('list', array("conditions"=>array("city_id"=>$this->data["Product"]["city_id"])));
		$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
                
                //wards
                $wards[0] = "- ".__('Phường/Xã', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $ws = $this->Product->Ward->find('list', array("conditions"=>array("Ward.district_id"=>$this->data["Product"]["district_id"])));
                    foreach($ws as $key => $value)
                    {
                            $wards[$key] = $value;
                    }
                }
                
                //streets
                $streets[0] = "- ".__('Tên đường', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $strts = $this->Product->Street->find("all");		
                    foreach($strts as $kk => $item)
                    {
                            $ok = false;		
                            if(isset($item['DistrictsStreet']))
                            {
                                    
                                    foreach($item['DistrictsStreet'] as $dt)
                                    {					
                                            if($dt['district_id'] == $this->data["Product"]["district_id"])
                                            {
                                                    $ok = true;
                                                    break;						
                                            }					
                                    }
                            }
                            if(!$ok)
                            {
                                    unset($strts[$kk]);
                            }
                    }
                    foreach($strts as $key => $value)
                    {
                            $streets[$value['Street']['id']] = $value['Street']['name'];
                    }
                }
                
                
                
		$pros = $this->Product->Project->find('list', array("conditions"=>array("district_id"=>$this->data["Product"]["district_id"])));
		//$projects = array_merge(array("0"=>"- choose one -"), $projects);
		$projects[0] = "- ".__('choose one', true)." -";
		foreach($pros as $key => $value)
		{
			$projects[$key] = $value;
		}
		$occupantTypes = $this->Product->OccupantType->find('list');
		$certificates = $this->Product->Certificate->find('list');
		$users = $this->Product->User->find('list');
		$currencies = $this->Product->CurrencyPrice->find('all', array('order'=>'CurrencyPrice.order'));
		
		//Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->data["Product"]["id"])));
		
		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'images', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_publish($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
                
                //if product ok
                if($product["Product"]["published"] == 1)
                {
                    $product["Product"]["published"] = 2;
                    
                    //Renew product
                    $today = date('Y-m-d H:i:s');
		    $product["Product"]["expire_date"] = date('Y-m-d H:i:s', strtotime($today)+(14*24*3600));
                    
                    //send alert mail
                    parent::sendAlerts($product);
                    
                    $this->Session->setFlash(__('Tin đã được duyệt.', true));
                }
		
		
		if ($this->Product->save($product)) {			
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
        
        function admin_notvalid($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
                
                //if product ok
                if($product["Product"]["published"] == 1)
                {
                    $product["Product"]["published"] = -2;                    
                   
                    $this->Session->setFlash(__('Tin đã bị loại.', true));
                }
		
		
		if ($this->Product->save($product)) {			
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_feature($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["featured"] = !$product["Product"]["featured"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_index() {
		$this->Product->recursive = 0;
		
		$user = $this->Auth->user();
		
		//Get all filters
		$conditions = array('Product.user_id'=>$user["User"]["id"]);
		
		////filter category
		//$cat_id = !empty($this->params['form']['filter_ctegory_id']) ? $this->params['form']['filter_ctegory_id'] : 0;
		//$cats = $this->Product->Category->find('all');
		//if($cat_id)
		//{
		//	$conditions["Product.category_id"] = $cat_id;				
		//}
		//
		////filter for
		//$for = !empty($this->params['form']['filter_for']) ? $this->params['form']['filter_for'] : '0';
		////$cats = $this->Product->Category->find('all');
		//if($for)
		//{
		//	$conditions["Product.for"] = $for;				
		//}
		//
		////filter module		
		//if(!empty($this->params['form']['filter_module']) || (isset($this->params['form']['filter_module']) && $this->params['form']['filter_module'] == 0))
		//{
		//	$module = $this->params['form']['filter_module'];
		//}
		//else
		//	$module = $this->Session->read("filter_module");
		////echo $for."ooo";	
		//$this->Session->write("filter_module", $module);
		//if($module)
		//{
		//	$conditions["Product.".$module] = 1;				
		//}
		//
		////filter bedrooms
		//$bedrooms = !empty($this->params['form']['filter_bedrooms']) ? $this->params['form']['filter_bedrooms'] : '0';
		////$cats = $this->Product->Category->find('all');
		//if($bedrooms)
		//{
		//	$conditions["Product.bedrooms >="] = $bedrooms;				
		//}
		//
		////filter bathrooms
		//$bathrooms = !empty($this->params['form']['filter_bathrooms']) ? $this->params['form']['filter_bathrooms'] : '0';
		////$cats = $this->Product->Category->find('all');
		//if($bathrooms)
		//{
		//	$conditions["Product.bedrooms >="] = $bathrooms;				
		//}
		//
		////filter district
		//$city_id = !empty($this->params['form']['filter_city_id']) ? $this->params['form']['filter_city_id'] : 0;
		//if($city_id)
		//{
		//	$conditions["Product.city_id"] = $city_id;
		//	$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		//	$projects = array();
		//}
		//else
		//{
		//	$districts = array();
		//	$projects = array();
		//}
		//
		////filter project
		//$district_id = !empty($this->params['form']['filter_district_id']) ? $this->params['form']['filter_district_id'] : 0;
		//$districts = $this->Product->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		//if($district_id)
		//{
		//	$conditions["Product.district_id"] = $district_id;			
		//	$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//}
		//
		////filter project
		//$project_id = !empty($this->params['form']['filter_project_id']) ? $this->params['form']['filter_project_id'] : 0;
		//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//if($project_id)
		//{
		//	$conditions["Product.project_id"] = $project_id;			
		//	//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//}
		//
		////filter project
		//$keyword = !empty($this->params['form']['filter_keyword']) ? $this->params['form']['filter_keyword'] : '';
		////$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//if($keyword != '')
		//{
		//	$conditions["Product.name LIKE ?"] = '%'.$keyword.'%';			
		//	//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//}
		//
		//
		////filter product price		
		//$price_range = !empty($this->params['form']['filter_product_price']) ? $this->params['form']['filter_product_price'] : '';
		//if($price_range != '' && $price_range != '0')
		//{
		//	$price_arr = explode('-', $price_range);
		//	//var_dump($price_arr);
		//	$s_price = $price_arr[0] != '' ? $price_arr[0] : 0;
		//	$e_price = $price_arr[1] != '' ? $price_arr[1] : 1000000000000000000;
		//	//echo $s_price."sd".$e_price;
		//	//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//	if($price_range != '')
		//	{
		//		$conditions["Product.price BETWEEN ? AND ?"] = array($s_price, $e_price);			
		//		//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//	}
		//}
		//
		////filter product area		
		//$area_range = !empty($this->params['form']['filter_product_area']) ? $this->params['form']['filter_product_area'] : '';
		//if($area_range != '' && $area_range != '0')
		//{
		//	$area_arr = explode('-', $area_range);
		//	//var_dump($price_arr);
		//	$s_area = $area_arr[0] != '' ? $area_arr[0] : 0;
		//	$e_area = $area_arr[1] != '' ? $area_arr[1] : 10000000000;
		//	//echo $s_price."sd".$e_price;
		//	//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//	if($area_range != '')
		//	{
		//		$conditions["Product.property_area BETWEEN ? AND ?"] = array($s_area, $e_area);			
		//		//$projects = $this->Product->Project->find('all',array('conditions'=>array('Project.district_id'=>$district_id)));
		//	}
		//}
		
		//filter product published		
		if(!empty($this->params['form']['filter_published']) || (isset($this->params['form']['filter_published']) && $this->params['form']['filter_published'] == 0))
		{
			$published = $this->params['form']['filter_published'];
		}
		else
			$published = $this->Session->read("filter_published");
		
		$this->Session->write("filter_published", $published);
		
		if($published != '' && $published != 'all')
		{
			$conditions["Product.published"] = $published;
		}
                
                //filter pay status		
		if(!empty($this->params['form']['filter_pay_status']) || (isset($this->params['form']['filter_pay_status']) && $this->params['form']['filter_pay_status'] == 0))
		{
			$pay_status = $this->params['form']['filter_pay_status'];
		}
		else
			$pay_status = $this->Session->read("filter_pay_status");
		
		$this->Session->write("filter_pay_status", $pay_status);
		
		if($pay_status != '' && $pay_status != 'all')
		{
			$conditions["Product.pay_status"] = $pay_status;
		}
                
		
		$this->paginate = array('conditions'=>$conditions);
		$products = $this->paginate();
		
		
		foreach($products as $key => $p)
		{
			$image = $this->Product->ProductImage->find('first', array(
									'conditions'=>array(
										'ProductImage.product_id'=>$p["Product"]["id"]
									)
								));
			$products[$key]['ProductImage'] = $image["ProductImage"];
			
			$products[$key]["Product"]["link"] = array('manager'=>false,'controller'=>'products', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Product"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
			
			//Checkout
			$new_order = $this->Product->Order->find('first', array(
									'conditions'=>array(
										'Order.product_id'=>$p["Product"]["id"],
										'Order.status'=>'new'
									)
								));
			//echo count($new_order);
			
			if($new_order != false)
			{
				//var_dump($new_order);
				$products[$key]["NewOrder"] = $new_order["Order"];				
				//var_dump($new_order);
			}
			//var_dump($products[$key]["NewOrder"]);
			
			
			//ngày còn lại
			$products[$key]['Product']['days'] = round((strtotime($p["Product"]["expire_date"])-strtotime(date('Y-m-d H:i:s')))/(3600*24), 0);
			$products[$key]['Product']['days'] = $products[$key]['Product']['days'] <= 0 ? 0 : $products[$key]['Product']['days'] ;
			
			//perm2
			if($p['Product']['price_perm2'] == 1)
				$products[$key]['Product']['price_perm2'] = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$products[$key]['Product']['price_perm2'] = "/tháng";
			else $products[$key]['Product']['price_perm2'] = "";
			
		}
		//var_dump($products);
		
		
		
		
		//filter 
		$cities = $this->Product->City->find('all');
		//$districts = $this->Product->District->find('all');
		//$projects = $this->Product->Project->find('all');
		
		$this->set('products', $products);
		$this->set('cities', $cities);
		//$this->set('city_id', $city_id);
		//$this->set('districts', $districts);
		//$this->set('district_id', $district_id);
		//$this->set('projects', $projects);
		//$this->set('project_id', $project_id);
		//$this->set('keyword', $keyword);
		//$this->set('price_range', $price_range);
		//$this->set('area_range', $area_range);
		//$this->set('cats', $cats);
		//$this->set('cat_id', $cat_id);
		//$this->set('for', $for);
		//$this->set('bedrooms', $bedrooms);
		//$this->set('bathrooms', $bathrooms);
		//$this->set('module', $module);
		//$this->set('count', $count);
		$this->set('published', $published);
                $this->set('pay_status', $pay_status);
	}

	function manager_view($id = null) {	
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		
		
		$product = $this->Product->read(null, $id);
		
		//Format number 000.000.000
			$product["Product"]["price"] = $product["Product"]["price"] != '' ? number_format($product["Product"]["price"],0,".", ",") : "";
			$product["Product"]["property_area"] = $product["Product"]["property_area"] != '' ? number_format($product["Product"]["property_area"],0,".", ",") : "";
			$product["Product"]["lot_area"] = $product["Product"]["lot_area"] != '' ? number_format($product["Product"]["lot_area"],0,".", ",") : "";
			$product["Product"]["commission"] = $product["Product"]["commission"] != '' ? number_format($product["Product"]["commission"],0,".", ",") : "";
		
		//Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$product["Product"]["id"])));
		
		$this->set('product', $product);
		$this->set('images', $images);
	}

	function manager_add() {
		$type_id = 1;
		$city_id = 1;
		$district_id = 1;
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		$user = $this->Auth->user();
                
                $this->Session->write("new_register", "0");
		//$this->Session->delete("temp_images");
		
		$utilities = $this->Utility->find('all');
		$uti_array = array();
		
		//var_dump($this->data);
		
		if (!empty($this->data)) {
			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			$this->data["Product"]["user_id"] = $user["User"]["id"];
			$this->data["Product"]["published"] = 0;
                        
                        if(isset($this->params['form']['postnew']))
                        {
                            $this->data["Product"]["published"] = 1;
                        }
			
			
			
			if($this->data["Product"]["type_id"] == 3)
			{
				$this->data["Product"]["property_area"] = 0;
				$this->data["Product"]["bedrooms"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
				$this->data["Product"]["floors"] = 0;
			}
			else if($this->data["Product"]["type_id"] == 2)
			{
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
			}
			//echo $this->data["Product"]["commission"]."sdfdsdfsdf";
			
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			//var_dump($this->data);		
			//var_dump($this->data["ProductsUtility"]);
			
			if(!isset($this->params['form']['preview']) && !isset($this->params['form']['upload'])) {				
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('Sản phẩm đã được thêm thành công', true));
					
					//save images
					foreach($this->data["ProductImage"] as $item)
					{
						if($item["filename"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $this->data["Product"]["name"];
							$image["ProductImage"]["product_id"] = $this->Product->id;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								//$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
							} else {
								//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
							}
						}
					}
					
					//save temp images
					$images_array = $this->Session->read('temp_images');
					$images = array();
					if(count($images_array))
					{
						if($this->Product->ProductImage->updateAll(array('ProductImage.product_id'=>$this->Product->id,'ProductImage.title'=>"'".$this->data["Product"]["name"]."'"), array('ProductImage.id'=>$images_array)))
						{
							$this->Session->delete("temp_images");
						}
						
					}
					
					
					//save attributes
					//var_dump($this->data["ProductsUtility"]);
									
					
					foreach($utilities as $item)
					{
						$pu["ProductsUtility"]["product_id"] = $this->Product->id;
						$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
					
						if(in_array($item["Utility"]["id"], $uti_array))
						{						
							$pu["ProductsUtility"]["value"] = 1;
						}
						else
						{
							$pu["ProductsUtility"]["value"] = 0;
						}
						
						$exist = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$pu["ProductsUtility"]["product_id"], "ProductsUtility.utility_id"=>$pu["ProductsUtility"]["utility_id"])));
						
						if($exist)
						{
							$pu["ProductsUtility"]["id"] = $exist["ProductsUtility"]["id"];
						}
						else
						{
							$this->ProductsUtility->create();
						}
						
						if ($this->ProductsUtility->save($pu["ProductsUtility"])) {
							$this->Session->setFlash(__('Sản phẩm đã được thêm thành công.', true));
								//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
					
					
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin sản phẩm.', true));
				}
			}
                        else if(isset($this->params['form']['preview']))
                        {
                            $this->layout = 'home';
                            Controller::loadModel('UserProfile');
                            
                            $profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
                            
                            
                            /////
                            $relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$this->data["Product"]["district_id"],
									'Product.for'=>$this->data["Product"]["for"],
									'Product.category_id'=>$this->data["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($this->data["Product"]["price"]*0.85, $this->data["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($this->data["Product"]["lot_area"]*0.8, $this->data["Product"]["lot_area"]*1.2),
									'published'=>1
								),
								'limit'=>5
							));
                            foreach($relatedProducts as $key => $p)
                            {
                                $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
                                //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
                                $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
                                                                                                                         'city'=>strtolower(Inflector::slug($p["City"]["name"])),
                                                                                                                         'id'=>$p["Product"]["id"],
                                                                                                                         'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
                            
                            
                                    if($p["Product"]["price"]) {
                                            if($p['Product']['price_perm2'] == 1)
                                                    $cur = "/m2";
                                            else if($p['Product']['price_perm2'] == 2)
                                                    $cur = "/tháng";
                                            else $cur = "";
                                    
                                            $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
                                                    
                                                    $relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
                                                                                        'id'=>$item['Currency']['id'],
                                                                                        'code'=>$item['Currency']['code'],
                                                                                        'value'=>$value
                                                                            );
                                            }
                                    }
                                    else
                                    {
                                                    $relatedProducts[$key]["Product"]["price"] = 0;
                                    }	
                                
                            }
                            
                            
                            /////
                            $this->data["Product"]["create_date"] = date('Y-m-d H:i');
                            
                            ////////
                            if($this->data["Product"]["price"]) {
                                    if($this->data['Product']['price_perm2'] == 1)
                                            $cur = "/m2";
                                    else if($this->data['Product']['price_perm2'] == 2)
                                            $cur = "/tháng";
                                    else $cur = "";
                                    
                                    
                                    $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
                                    $rate = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Product"]['price_currency'])));
                                    foreach($currency_list as $item)
                                    {
                                            $value = ($this->data["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $rate["Currency"]["rate"]);
                                            
                                            if($item["Currency"]["id"] == 2)
                                                    $value = parent::priceFormat(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"]).$cur;
                                            else
                                            {
                                                    $tp = $item["Currency"]["id"] == 3 ? 3 : 0;
                                                    $value = number_format(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
                                            }
                                            
                                            $this->data["prices"][$item['Currency']['id']] = array(
                                                                                'id'=>$item['Currency']['id'],
                                                                                'code'=>$item['Currency']['code'],
                                                                                'value'=>$value
                                                                    );
                                    }
                            }
                            else
                            {
                                    $this->data["Product"]["price"] = 0;
                            }
                            
                            //Type
                            $rec = $this->Product->Type->find('first', array('conditions'=>array('Type.id'=>$this->data["Product"]['type_id'])));
                            $this->data['Type'] = $rec['Type'];
                            
                            //City
                            $rec = $this->Product->City->find('first', array('conditions'=>array('City.id'=>$this->data["Product"]['city_id'])));
                            $this->data['City'] = $rec['City'];
                            //District
                            $rec = $this->Product->District->find('first', array('conditions'=>array('District.id'=>$this->data["Product"]['district_id'])));
                            $this->data['District'] = $rec['District'];
                            //Ward
                            $rec = $this->Product->Ward->find('first', array('conditions'=>array('Ward.id'=>$this->data["Product"]['ward_id'])));
                            $this->data['Ward'] = $rec['Ward'];
                            //Street
                            $rec = $this->Product->Street->find('first', array('conditions'=>array('Street.id'=>$this->data["Product"]['street_id'])));
                            $this->data['Street'] = $rec['Street'];
                            //Project
                            $rec = $this->Product->Project->find('first', array('conditions'=>array('Project.id'=>$this->data["Product"]['project_id'])));
                            $this->data['Project'] = $rec['Project'];                            
                             //Certificate  
                            $rec = $this->Product->Certificate->find('first', array('conditions'=>array('Certificate.id'=>$this->data["Product"]['certificate_id'])));
                            $this->data['Certificate'] = $rec['Certificate'];
                            
                            ///
                            $this->data["Product"]["ncreate_date"] = $this->data["Product"]["create_date"];
                            $this->data["Product"]["create_date"] = parent::dateFormat($this->data["Product"]["create_date"]);
                            
                            //
                            $cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
                            
                            $uti_array = array();
                            if(isset($this->data["ProductsUtility"]))
                                foreach($this->data["ProductsUtility"] as $item)
                                {
                                            $uti_array[] = $item["id"];					
                                }
                            $this->Session->setFlash(__('Đây là trang minh họa cho sản phẩm BĐS, nội dung chỉ đê tham khảo.', true));
                            $this->set('product', $this->data);
                            $this->set('profile', $profile);
                            $this->set('relatedProducts', $relatedProducts);
                            $this->set('cat', $cat);
                            $this->set('uti_array', $uti_array);
			    
			    //temp images
				$images_array = $this->Session->read('temp_images');
				$images = array();
				if(count($images_array))
				{
					$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
				}
				$this->set('images', $images);
			    
                            $this->render('details_preview');
                        }
			else if(isset($this->params['form']['upload']))
                        {
					//save images
					//$this->Session->write('temp_image_', $this->Product->ProductImage->id);
					foreach($this->data["ProductImage"] as $key => $item)
					{
						//var_dump($item["filename"]["name"]);
						if($item["filename"]["name"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = "temp";
							$image["ProductImage"]["product_id"] = -1;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								$this->Session->setFlash(__('Ảnh đã được tải thành công.', true));
								$count_image = count($this->Session->read('temp_images'));
								$this->Session->write('temp_images.'.$count_image, $this->Product->ProductImage->id);
								//$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('Lỗi khi tải ảnh, vui lòng kiểm tra thông tin yêu cầu.', true));
							}
						}
					}
			}
			
			//Filter type city district
			$type_id = $this->data["Product"]["type_id"];
			$city_id = $this->data["Product"]["city_id"];
			$cat_id = $this->data["Product"]["category_id"];
			$district_id = $this->data["Product"]["district_id"];
			
			$this->data["Product"]["price"] = $this->data["Product"]["price"] != '' ? number_format($this->data["Product"]["price"],0,".", ",") : "";
			$this->data["Product"]["property_area"] = $this->data["Product"]["property_area"] != '' ? number_format($this->data["Product"]["property_area"],0,".", ",") : "";
			$this->data["Product"]["lot_area"] = $this->data["Product"]["lot_area"] != '' ? number_format($this->data["Product"]["lot_area"],0,".", ",") : "";
			$this->data["Product"]["commission"] = $this->data["Product"]["commission"] != '' ? number_format($this->data["Product"]["commission"],0,".", ",") : "";
			
		}
		//var_dump($this->data);
		//temp images
		$images_array = $this->Session->read('temp_images');
		$images = array();
		if(count($images_array))
		{
			$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.id'=>$images_array)));
		}
		
		
		
		$types = $this->Product->Type->find('list');
		$categories = $this->Product->Category->find('list', array("conditions"=>array("type_id"=>$type_id)));
		
		$cats = $this->Product->Category->find('all', array("conditions"=>array("type_id"=>$type_id)));
		if(isset($this->data["Product"]["category_id"]))
			$cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
		else
			$cat = $this->Product->Category->read(null, $cats[0]["Category"]["id"]);
		//var_dump($cat);
		
		$cities = $this->Product->City->find('list');
		$this->data["Product"]["city_id"] = $city_id;
		$dits = $this->Product->District->find('list', array("conditions"=>array("city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
                
                //wards
                $wards[0] = "- ".__('Phường/Xã', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $ws = $this->Product->Ward->find('list', array("conditions"=>array("Ward.district_id"=>$this->data["Product"]["district_id"])));
                    foreach($ws as $key => $value)
                    {
                            $wards[$key] = $value;
                    }
                }
                
                //streets
                $streets[0] = "- ".__('Tên đường', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $strts = $this->Product->Street->find("all");		
                    foreach($strts as $kk => $item)
                    {
                            $ok = false;		
                            if(isset($item['DistrictsStreet']))
                            {
                                    
                                    foreach($item['DistrictsStreet'] as $dt)
                                    {					
                                            if($dt['district_id'] == $this->data["Product"]["district_id"])
                                            {
                                                    $ok = true;
                                                    break;						
                                            }					
                                    }
                            }
                            if(!$ok)
                            {
                                    unset($strts[$kk]);
                            }
                    }
                    foreach($strts as $key => $value)
                    {
                            $streets[$value['Street']['id']] = $value['Street']['name'];
                    }
                }
                
                
		$pros = $this->Product->Project->find('list', array("conditions"=>array("district_id"=>$district_id)));

		$projects[0] = "- ".__('khác', true)." -";
		foreach($pros as $key => $value)
		{
			$projects[$key] = $value;
		}
		$occupantTypes = $this->Product->OccupantType->find('list');
		$certificates = $this->Product->Certificate->find('list');
		$users = $this->Product->User->find('list');
		$currencies = $this->Product->CurrencyPrice->find('all', array('order'=>'CurrencyPrice.order'));
		//var_dump($this->data);
		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets', 'images'));		
	}

	function manager_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		$uti_array = array();
		$utilities = $this->Utility->find('all');
		
		if (!empty($this->data)) {
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			
			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			$this->data["Product"]["user_id"] = $user["User"]["id"];
                        
                        if(isset($this->params['form']['postnew']))
                        {
                            $this->data["Product"]["published"] = 1;
                        }
			
			
			
			if($this->data["Product"]["type_id"] == 3)
			{
				$this->data["Product"]["property_area"] = 0;
				$this->data["Product"]["bedrooms"] = 0;
				$this->data["Product"]["bathrooms"] = 0;
				$this->data["Product"]["build_area"] = 0;
				$this->data["Product"]["floors"] = 0;
			}
			
			if($this->data["Product"]["type_id"] == 2)
			{
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
				$this->data["Product"]["build_area"] = 0;
			}
			
			//var_dump($this->data["ProductImage"])."kreuhkjerthe";
			if(!isset($this->params['form']['preview']) && !isset($this->params['form']['upload'])) {
                            if ($this->Product->save($this->data)) {
                                    $this->Session->setFlash(__('Sản phẩm đã được lưu thành công', true));
                                    
                                    //save images
                                    foreach($this->data["ProductImage"] as $item)
                                    {
                                            if($item["filename"] != "")
                                            {
                                                    $image["ProductImage"] = $item;
                                                    $image["ProductImage"]["title"] = $this->data["Product"]["name"];
                                                    $image["ProductImage"]["product_id"] = $this->Product->id;
                                                    
                                                    $this->Product->ProductImage->create();
                                                    if ($this->Product->ProductImage->save($image["ProductImage"])) {
                                                            $this->Session->setFlash(__('Sản phẩm đã được lưu thành công.', true));
                                                            //$this->redirect(array('action' => 'index'));
                                                    } else {
                                                            //$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
                                                    }
                                            }
                                    }
                                    
                                    //save attributes
                                    //var_dump($this->data["ProductsUtility"]);				
                                    foreach($utilities as $item)
                                    {
                                            //$pu["ProductsUtility"]["product_id"] = $this->Product->id;
                                            //$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
                                            
                                            $pu = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$this->data["Product"]["id"],
                                                                                                                  "ProductsUtility.utility_id"=>$item["Utility"]["id"])));
                                            
                                            if(!$pu)
                                            {
                                                    $pu["ProductsUtility"]["product_id"] = $this->data["Product"]["id"];
                                                    $pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];
                                                    $this->ProductsUtility->create();
                                            }
                                            //var_dump($pu);
                                            if(in_array($item["Utility"]["id"], $uti_array))
                                            {						
                                                    $pu["ProductsUtility"]["value"] = 1;
                                            }
                                            else
                                            {
                                                    $pu["ProductsUtility"]["value"] = 0;
                                            }
                                            
                                            
                                            //var_dump($pu);
                                            if ($this->ProductsUtility->save($pu["ProductsUtility"])) {
                                                    $this->Session->setFlash(__('Sản phẩm đã được lưu thành công.', true));
                                                            //$this->redirect(array('action' => 'index'));
                                            } else {
                                                    $this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
                                            }
                                    }
                                    
                                    
                                    
                                    $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin sản phẩm.', true));
                            }
                        }
                        else if(isset($this->params['form']['preview']))
                        {
                            $this->layout = 'home';
                            Controller::loadModel('UserProfile');
                            
                            $profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$user["User"]["id"])));
                            
                            
                            /////
                            $relatedProducts = $this->Product->find("all", array(
								'conditions'=>array(
									'Product.district_id'=>$this->data["Product"]["district_id"],
									'Product.for'=>$this->data["Product"]["for"],
									'Product.category_id'=>$this->data["Product"]["category_id"],
									'Product.price BETWEEN ? AND ?' => array($this->data["Product"]["price"]*0.85, $this->data["Product"]["price"]*1.15),
									'Product.lot_area BETWEEN ? AND ?' => array($this->data["Product"]["lot_area"]*0.8, $this->data["Product"]["lot_area"]*1.2),
									'published'=>1
								),
								'limit'=>5
							));
                            foreach($relatedProducts as $key => $p)
                            {
                                $relatedProducts[$key]["Product"]["name"] = parent::snippet(strip_tags($p["Product"]["name"]), 40);
                                //$relatedProducts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
                                $relatedProducts[$key]["Product"]["link"] = array('controller'=>'products', 'action'=>'details',
                                                                                                                         'city'=>strtolower(Inflector::slug($p["City"]["name"])),
                                                                                                                         'id'=>$p["Product"]["id"],
                                                                                                                         'name'=>strtolower(Inflector::slug($p["Product"]["name"])));
                            
                            
                                    if($p["Product"]["price"]) {
                                            if($p['Product']['price_perm2'] == 1)
                                                    $cur = "/m2";
                                            else if($p['Product']['price_perm2'] == 2)
                                                    $cur = "/tháng";
                                            else $cur = "";
                                    
                                            $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
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
                                                    
                                                    $relatedProducts[$key]["prices"][$item['Currency']['id']] = array(
                                                                                        'id'=>$item['Currency']['id'],
                                                                                        'code'=>$item['Currency']['code'],
                                                                                        'value'=>$value
                                                                            );
                                            }
                                    }
                                    else
                                    {
                                                    $relatedProducts[$key]["Product"]["price"] = 0;
                                    }	
                                
                            }
                            
                            
                            /////
                            $this->data["Product"]["create_date"] = date('Y-m-d H:i');
                            
                            ////////
                            if($this->data["Product"]["price"]) {
                                    if($this->data['Product']['price_perm2'] == 1)
                                            $cur = "/m2";
                                    else if($this->data['Product']['price_perm2'] == 2)
                                            $cur = "/tháng";
                                    else $cur = "";
                                    
                                    
                                    $currency_list = $this->Currency->find('all', array('order'=>'Currency.order'));
                                    $rate = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Product"]['price_currency'])));
                                    foreach($currency_list as $item)
                                    {
                                            $value = ($this->data["Product"]["price"]*$item["Currency"]["rate"])/str_replace(',', '.', $rate["Currency"]["rate"]);
                                            
                                            if($item["Currency"]["id"] == 2)
                                                    $value = parent::priceFormat(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"]).$cur;
                                            else
                                            {
                                                    $tp = $item["Currency"]["id"] == 3 ? 3 : 0;
                                                    $value = number_format(($this->data["Product"]["price"]*$item["Currency"]["rate"])/$rate["Currency"]["rate"],$tp,".", " ")." ".$item["Currency"]["code"].$cur;
                                            }
                                            
                                            $this->data["prices"][$item['Currency']['id']] = array(
                                                                                'id'=>$item['Currency']['id'],
                                                                                'code'=>$item['Currency']['code'],
                                                                                'value'=>$value
                                                                    );
                                    }
                            }
                            else
                            {
                                    $this->data["Product"]["price"] = 0;
                            }
                            
                            //Type
                            $rec = $this->Product->Type->find('first', array('conditions'=>array('Type.id'=>$this->data["Product"]['type_id'])));
                            $this->data['Type'] = $rec['Type'];
                            
                            //City
                            $rec = $this->Product->City->find('first', array('conditions'=>array('City.id'=>$this->data["Product"]['city_id'])));
                            $this->data['City'] = $rec['City'];
                            //District
                            $rec = $this->Product->District->find('first', array('conditions'=>array('District.id'=>$this->data["Product"]['district_id'])));
                            $this->data['District'] = $rec['District'];
                            //Ward
                            $rec = $this->Product->Ward->find('first', array('conditions'=>array('Ward.id'=>$this->data["Product"]['ward_id'])));
                            $this->data['Ward'] = $rec['Ward'];
                            //Street
                            $rec = $this->Product->Street->find('first', array('conditions'=>array('Street.id'=>$this->data["Product"]['street_id'])));
                            $this->data['Street'] = $rec['Street'];
                            //Project
                            $rec = $this->Product->Project->find('first', array('conditions'=>array('Project.id'=>$this->data["Product"]['project_id'])));
                            $this->data['Project'] = $rec['Project'];                            
                             //Certificate  
                            $rec = $this->Product->Certificate->find('first', array('conditions'=>array('Certificate.id'=>$this->data["Product"]['certificate_id'])));
                            $this->data['Certificate'] = $rec['Certificate'];
                            
                            ///
                            $this->data["Product"]["ncreate_date"] = $this->data["Product"]["create_date"];
                            $this->data["Product"]["create_date"] = parent::dateFormat($this->data["Product"]["create_date"]);
                            
                            //
                            $cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
                            
                            $uti_array = array();
                            if(isset($this->data["ProductsUtility"]))
                                foreach($this->data["ProductsUtility"] as $item)
                                {
                                            $uti_array[] = $item["id"];					
                                }
                            $this->Session->setFlash(__('Đây là trang minh họa cho sản phẩm BĐS, nội dung chỉ đê tham khảo.', true));
                            $this->set('product', $this->data);
                            $this->set('profile', $profile);
                            $this->set('relatedProducts', $relatedProducts);
                            $this->set('cat', $cat);
                            $this->set('uti_array', $uti_array);
			    
			    //Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->data["Product"]["id"])));
				$this->set('images', $images);
			    
                            $this->render('details_preview');
                        }
			else if(isset($this->params['form']['upload']))
			{
				//save images
					//$this->Session->write('temp_image_', $this->Product->ProductImage->id);
					foreach($this->data["ProductImage"] as $key => $item)
					{
						//var_dump($item["filename"]["name"]);
						if($item["filename"]["name"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $this->data['Product']['name'];
							$image["ProductImage"]["product_id"] = $this->data['Product']['id'];;
							
							$this->Product->ProductImage->create();
							if ($this->Product->ProductImage->save($image["ProductImage"])) {
								$this->Session->setFlash(__('Ảnh đã được tải thành công.', true));
								//$count_image = count($this->Session->read('temp_images'));
								//$this->Session->write('temp_images.'.$count_image, $this->Product->ProductImage->id);
								//$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('Lỗi khi tải ảnh, vui lòng kiểm tra thông tin yêu cầu.', true));
							}
						}
					}
			}
			
			
		}
		if (empty($this->data)) {			
			$this->data = $this->Product->read(null, $id);
			
			$uti_array = array();
			foreach($utilities as $item)
			{
					//$pu["ProductsUtility"]["product_id"] = $this->Product->id;
					//$pu["ProductsUtility"]["utility_id"] = $item["Utility"]["id"];					
				$pu = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$this->data["Product"]["id"], "ProductsUtility.utility_id"=>$item["Utility"]["id"])));
				if($pu["ProductsUtility"]["value"] == 1)
					$uti_array[] = $pu["ProductsUtility"]["utility_id"];
			}
		}
		
		
		//Format number 000.000.000
			$this->data["Product"]["price"] = $this->data["Product"]["price"] != '' ? number_format($this->data["Product"]["price"],0,".", ",") : "";
			$this->data["Product"]["property_area"] = $this->data["Product"]["property_area"] != '' ? number_format($this->data["Product"]["property_area"],0,".", ",") : "";
			$this->data["Product"]["lot_area"] = $this->data["Product"]["lot_area"] != '' ? number_format($this->data["Product"]["lot_area"],0,".", ",") : "";
			//$this->data["Product"]["commission"] = $this->data["Product"]["commission"] != '' ? number_format($this->data["Product"]["commission"],0,".", ",") : "";
		
		
		$types = $this->Product->Type->find('list');
		$categories = $this->Product->Category->find('list', array("conditions"=>array("type_id"=>$this->data["Product"]["type_id"])));
		$cat = $this->Product->Category->read(null, $this->data["Product"]["category_id"]);
		$cities = $this->Product->City->find('list');
		$dits = $this->Product->District->find('list', array("conditions"=>array("city_id"=>$this->data["Product"]["city_id"])));
		$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
                
                //wards
                $wards[0] = "- ".__('Phường/Xã', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $ws = $this->Product->Ward->find('list', array("conditions"=>array("Ward.district_id"=>$this->data["Product"]["district_id"])));
                    foreach($ws as $key => $value)
                    {
                            $wards[$key] = $value;
                    }
                }
                
                //streets
                $streets[0] = "- ".__('Tên đường', true)." -";
                if(isset($this->data["Product"]["district_id"]))
                {
                    $strts = $this->Product->Street->find("all");		
                    foreach($strts as $kk => $item)
                    {
                            $ok = false;		
                            if(isset($item['DistrictsStreet']))
                            {
                                    
                                    foreach($item['DistrictsStreet'] as $dt)
                                    {					
                                            if($dt['district_id'] == $this->data["Product"]["district_id"])
                                            {
                                                    $ok = true;
                                                    break;						
                                            }					
                                    }
                            }
                            if(!$ok)
                            {
                                    unset($strts[$kk]);
                            }
                    }
                    foreach($strts as $key => $value)
                    {
                            $streets[$value['Street']['id']] = $value['Street']['name'];
                    }
                }
                
                
                
		$pros = $this->Product->Project->find('list', array("conditions"=>array("district_id"=>$this->data["Product"]["district_id"])));
		//$projects = array_merge(array("0"=>"- choose one -"), $projects);
		$projects[0] = "- ".__('choose one', true)." -";
		foreach($pros as $key => $value)
		{
			$projects[$key] = $value;
		}
		$occupantTypes = $this->Product->OccupantType->find('list');
		$certificates = $this->Product->Certificate->find('list');
		$users = $this->Product->User->find('list');
		$currencies = $this->Product->CurrencyPrice->find('all', array('order'=>'CurrencyPrice.order'));
		
		//Image list
		$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->data["Product"]["id"])));
		
		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'images', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_publish($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		
			//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		
		$product = $this->Product->read(null, $id);
                //add to validate list
                if($product["Product"]["published"] == 0)
                {
                    $product["Product"]["published"] = 1;
                    $this->Session->setFlash(__('Tin đã được đưa vào danh sách chờ duyệt.', true));
                }
                //turn on/off product
		else if($product["Product"]["published"] == 2 || $product['Product']['published'] == 3)
                {
			$product["Product"]["published"] = $product["Product"]["published"] == 2 ? 3 : 2;
                        $turn = $product["Product"]["published"] == 2 ? 'bật' : 'tắt';
                        $this->Session->setFlash(__('Tin đã được '.$turn.".", true));
                }
		if ($this->Product->save($product)) {			
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
        
        function manager_unpublish($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		
			//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		
		$product = $this->Product->read(null, $id);
                //add to validate list
                if($product["Product"]["published"] == 2 || $product["Product"]["published"] == 3)
                {
                    $product["Product"]["published"] = 0;
                    $product["Product"]["expire_date"] = $product["Product"]["create_date"];
                    $this->Session->setFlash(__('Tin đã ngừng đăng.', true));
                }
                
		if ($this->Product->save($product)) {			
			$this->redirect(array('action'=>'edit', $product["Product"]["id"]));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_renew($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		
			//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Product->User->isUserProduct($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		
		$product = $this->Product->read(null, $id);
		if (!$product["Product"]["published"]) {
			$this->Session->setFlash(__('Tin chưa được duyệt.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if($product["Product"]["published"] == 2 || $product["Product"]["published"] == 3 || $product["Product"]["published"] == -1)
                {
                    $product["Product"]["published"] = 2;
                    
                    //renew date
                    $today = date('Y-m-d H:i:s');
		    //$product["Product"]["hit"] = 0;
		    $product["Product"]["create_date"] = $today;
		    $product["Product"]["expire_date"] = date('Y-m-d H:i:s', strtotime($today)+(14*24*3600));
                    
                    $this->Session->setFlash(__('Sản phẩm đã được kích hoạt mới', true));
                }	
		
		if ($this->Product->save($product)) {
			
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_feature($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["featured"] = !$product["Product"]["featured"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_topnew($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["top_new"] = !$product["Product"]["top_new"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_tophit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["top_hit"] = !$product["Product"]["top_hit"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_topsale($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["top_sale"] = !$product["Product"]["top_sale"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_toplease($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		$product = $this->Product->read(null, $id);
		$product["Product"]["top_lease"] = !$product["Product"]["top_lease"] ? 1 : 0;
		if ($this->Product->save($product)) {
			$this->Session->setFlash(__('The product has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
        
        function getAdminSideBarCount()
	{
                $user = $this->Auth->user();
                
		$count = array();
                Controller::loadModel('Need');
                $count["no_paid"] = $this->Product->find('count', array('conditions'=>array('Product.pay_status'=>'0', 'Product.user_id'=>$user["User"]["id"])));
                $count["views"] = $this->Product->find('all', array('fields'=>'SUM(Product.hit) as count', 'conditions'=>array('Product.user_id'=>$user["User"]["id"])));
                $count["all"] = $this->Product->find('count', array('conditions'=>array('Product.user_id'=>$user["User"]["id"])));
                $count["sale"] = $this->Product->find('count', array('conditions'=>array('Product.for'=>'s', 'Product.user_id'=>$user["User"]["id"])));
                $count["lease"] = $this->Product->find('count', array('conditions'=>array('Product.for'=>'l', 'Product.user_id'=>$user["User"]["id"])));
                $count["need_sale"] = $this->Need->find('count', array('conditions'=>array('Need.for LIKE'=>'%s%', 'Need.user_id'=>$user["User"]["id"])));
                $count["need_lease"] = $this->Need->find('count', array('conditions'=>array('Need.for LIKE'=>'%l%', 'Need.user_id'=>$user["User"]["id"])));
                $count["favorite"] = $this->Product->Favorite->find('count', array('conditions'=>array('Favorite.user_id'=>$user["User"]["id"])));
                $count[-2] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'-2', 'Product.user_id'=>$user["User"]["id"])));
		$count[-1] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'-1', 'Product.user_id'=>$user["User"]["id"])));
		$count[0] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'0', 'Product.user_id'=>$user["User"]["id"])));
		$count[1] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'1', 'Product.user_id'=>$user["User"]["id"])));
		$count[2] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'2', 'Product.user_id'=>$user["User"]["id"])));
                $count[3] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'3', 'Product.user_id'=>$user["User"]["id"])));
                
                $count[4] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'2', 'Product.pay_status'=>'1', 'Product.user_id'=>$user["User"]["id"])));
                $count[5] = $this->Product->find('count', array('conditions'=>array('Product.published'=>'0', 'Product.pay_status'=>'1', 'Product.user_id'=>$user["User"]["id"])));
                
		return $count;
	}
        
        function setnewpost()
        {
            $this->Session->write("new_register", "1");
            $this->layout = null;
            return "1";
        }
        
        function addFavorite($pid = null)
        {
            
        }
}
