<?php
class FixpriceOrdersController extends AppController {

	var $name = 'FixpriceOrders';
	var $components = array('SwiftMailer'); 
	
	public function beforeFilter() {
		$this->Auth->allow('add', 'update_order_nl', 'add_paylater', 'order_result', 'sms_service');
	}

	function index() {
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceOrder', $this->FixpriceOrder->read(null, $id));
	}

	function add() {
		$this->layout = "home";		
		if (!empty($this->data)) {
			$this->FixpriceOrder->create();
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		$userProfiles = $this->FixpriceOrder->UserProfile->find('list');
		$users = $this->FixpriceOrder->User->find('list');
		$products = $this->FixpriceOrder->Product->find('list');
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('userProfiles', 'users', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpricePayments'));
	}
	
	function add_step1() {
		$this->layout = "home";
		$user = $this->Auth->user();
		
		if($this->Session->read("current_fixprice_order_id") != '')
		{
			$fixprice_order = $this->FixpriceOrder->read(null, $this->Session->read("current_fixprice_order_id"));
		}
		
		if (!empty($this->data)) {
			
			////var_dump($this->data['UserProfile']);
			//$this->FixpriceOrder->FixpriceCustomer->set($this->data);
			//if(!$this->FixpriceOrder->FixpriceCustomer->validates())
			//{
			//	$this->Session->setFlash(__('Bạn phải điền thông tin khách hàng.', true));
			//}
			//else
			//{
				
				$this->data['FixpriceOrder']['create_date'] = date('Y-m-d H:i:s');
				
				//Add user
				$this->data['FixpriceOrder']['user_id'] = $user["User"]["id"];
				
				
				if($this->Session->read("current_fixprice_order_id") != '')
				{
					$this->data['FixpriceOrder']['id'] = $this->Session->read("current_fixprice_order_id");
				}
				else
				{
					$this->FixpriceOrder->create();
				}
				
				if ($this->FixpriceOrder->save($this->data)) {
					
					//Set Product State
					$this->FixpriceOrder->setState($this->FixpriceOrder->id, 'NEW');
					
					
					//Store current fixprice_order id
					$this->Session->write("current_fixprice_order_id", $this->FixpriceOrder->id);
					
					$this->Session->setFlash(__('Thông tin khách hàng đã được lưu trữ. Bước tiếp theo vui lòng nhập thông tin BĐS cần thầm định', true));
					$this->redirect(array('action' => 'add_step2'));
				} else {
					$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
				}
			//}			
		}
		
		if($this->Session->read("current_fixprice_order_id") != '')
		{
			$this->data = $this->FixpriceOrder->read(null, $this->Session->read("current_fixprice_order_id"));
		}
		
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpriceService_descriptions = $this->FixpriceOrder->FixpriceService->find('all');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('fixpriceTypes', 'fixpriceServices', 'fixpriceService_descriptions', 'fixpricePayments'));
	}
	
	//function add_step1() {
	//	$this->layout = "home";
	//	
	//	if($this->Session->read("current_fixprice_order_id") != '')
	//	{
	//		$fixprice_order = $this->FixpriceOrder->read(null, $this->Session->read("current_fixprice_order_id"));
	//	}
	//	
	//	
	//	
	//	if (!empty($this->data)) {
	//		
	//		//var_dump($this->data['UserProfile']);
	//		$this->FixpriceOrder->FixpriceCustomer->set($this->data);
	//		if(!$this->FixpriceOrder->FixpriceCustomer->validates())
	//		{
	//			$this->Session->setFlash(__('Bạn phải điền thông tin khách hàng.', true));
	//		}
	//		else
	//		{
	//			
	//			if(isset($fixprice_order['FixpriceOrder']['fixprice_customer_id']))
	//			{
	//				$this->data['FixpriceCustomer']['id'] = $fixprice_order['FixpriceOrder']['fixprice_customer_id'];
	//			}
	//			
	//			$this->FixpriceOrder->FixpriceCustomer->save($this->data);
	//			
	//			$this->data['FixpriceOrder']['fixprice_customer_id'] = $this->FixpriceOrder->FixpriceCustomer->id;
	//			$this->data['FixpriceOrder']['create_date'] = date('Y-m-d H:i:s');
	//			
	//			//Check if user is exist
	//			$exist_user = $this->FixpriceOrder->User->find('first', array('conditions'=>array('User.email'=>$this->data['FixpriceCustomer']['email'])));
	//			if($exist_user)
	//			{
	//				$this->data['FixpriceOrder']['user_id'] = $exist_user['User']['id'];
	//			}
	//			
	//			if($this->Session->read("current_fixprice_order_id") != '')
	//			{
	//				$this->data['FixpriceOrder']['id'] = $this->Session->read("current_fixprice_order_id");
	//			}
	//			else
	//			{
	//				$this->FixpriceOrder->create();
	//			}
	//			
	//			if ($this->FixpriceOrder->save($this->data)) {
	//				
	//				//Store current fixprice_order id
	//				$this->Session->write("current_fixprice_order_id", $this->FixpriceOrder->id);
	//				
	//				$this->Session->setFlash(__('Thông tin khách hàng đã được lưu trữ. Bước tiếp theo vui lòng nhập thông tin BĐS cần thầm định', true));
	//				$this->redirect(array('action' => 'add_step2'));
	//			} else {
	//				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
	//			}
	//		}			
	//	}
	//	
	//	if(isset($fixprice_order['FixpriceOrder']['fixprice_customer_id']))
	//	{
	//		$this->data = $this->FixpriceOrder->FixpriceCustomer->read(null, $fixprice_order['FixpriceOrder']['fixprice_customer_id']);
	//	}
	//	
	//	$fixpriceCustomers = $this->FixpriceOrder->FixpriceCustomer->find('list');
	//	$users = $this->FixpriceOrder->User->find('list');
	//	$products = $this->FixpriceOrder->Product->find('list');
	//	$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
	//	$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
	//	$fixpriceService_descriptions = $this->FixpriceOrder->FixpriceService->find('all');
	//	$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
	//	$this->set(compact('fixpriceCustomers', 'users', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpriceService_descriptions', 'fixpricePayments'));
	//}
	
	function add_step2() {
		$this->layout = 'home';
		$type_id = 1;
		$city_id = 1;
		$district_id = 1;
		Controller::loadModel('Product');
		Controller::loadModel('Utility');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('Setting');
		$user = $this->Auth->user();
		
		//$this->FixpriceOrder->setState($this->Session->read("current_fixprice_order_id"), 'NEW_PRODUCT');
		
		//Get current fixprice order
		if($this->Session->read("current_fixprice_order_id") == '')
		{
			$this->Session->setFlash(__('Vui lòng điền thông tin khách hàng', true));
			$this->redirect(array('action' => 'add_step1'));
		}		
		$fixprice_order = $this->FixpriceOrder->read(null, $this->Session->read("current_fixprice_order_id"));		
                
		//echo $this->FixpriceOrder->getState($fixprice_order['FixpriceOrder']['id']);
		//$this->FixpriceOrder->setState($this->Session->read("current_fixprice_order_id"), 'PAID');
		
		//not new register
                $this->Session->write("new_register", "0");

		
		//Ultilities
		$utilities = $this->Utility->find('all');
		$uti_array = array();
		
		//var_dump($this->data);

		if (!empty($this->data)) {

			//convert number
			$this->data["Product"]["price"] = str_replace(",", "", $this->data["Product"]["price"]);
			$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			$this->data["Product"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			$this->data["Product"]["commission"] = 0;
			
			if(isset($fixprice_order['FixpriceOrder']['product_id']))
			{
				$this->data["Product"]["id"] = $fixprice_order['FixpriceOrder']['product_id'];
			}
			
			//product is known as for fixprice
			$this->data["Product"]["published"] = 10;
                        
			
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
			else if($this->data["Product"]["type_id"] == 4)
			{
				$this->data["Product"]["floors"] = $this->data["Product"]["floors"] == '' ? 0 :$this->data["Product"]["floors"];
				$this->data["Product"]["lot_area"] = 0;
				$this->data["Product"]["area_x"] = 0;
				$this->data["Product"]["area_y"] = 0;
				$this->data["Product"]["area_back"] = 0;
			}
			
			
			//attribute array
			if(isset($this->data["ProductsUtility"]))
				foreach($this->data["ProductsUtility"] as $item)
				{
					$uti_array[] = $item["id"];					
				}
			
			//Add user
			$this->data["Product"]["user_id"] = $user["User"]["id"];
			
			
			if(!isset($this->params['form']['save_later'])) {				
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					if(isset($this->params['form']['upload']))					
					{
						$this->Session->setFlash(__('Ảnh đã được lưu thành công.', true));
					}
					else
					{
						$this->Session->setFlash(__('Sản phẩm đã được thêm thành công', true));
					}
					
					//save images
					foreach($this->data["ProductImage"] as $item)
					{
						if($item["filename"] != "")
						{
							$image["ProductImage"] = $item;
							$image["ProductImage"]["title"] = $image["ProductImage"]["title"] == '' ? "noname" : $image["ProductImage"]["title"];
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
					
					//check count images
					$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->Product->id)));
					//echo count($images);
									
									
					//Save utilities
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
					
					//add product to fixprice order
					$fixprice_order['FixpriceOrder']['product_id'] = $this->Product->id;
					$fixprice_order['FixpriceOrder']['status'] = "1";
					
					if($this->FixpriceOrder->save($fixprice_order['FixpriceOrder']))
					{
						if(isset($this->params['form']['upload']))					
						{
							$this->Session->setFlash(__('Ảnh đã được lưu thành công.', true));
						}
						else
						{
							$this->Session->setFlash(__('Thông tin BĐS đã được lưu trữ. Quý khách xem lại thông tin của mình và tiến hành thanh toán phí dịch vụ.', true));
						}
						
						//save and add gtable to fixprice order
						$this->data['FixpriceGtable']['fixprice_order_id'] = $fixprice_order['FixpriceOrder']['id'];
						$this->data['FixpriceGtable']['id'] = $fixprice_order['FixpriceGtable']['id'];
						$this->FixpriceOrder->FixpriceGtable->save($this->data['FixpriceGtable']);
						
						$fixprice_ftable = $this->data['FixpriceGtable'];					
					}
					
					if(!isset($this->params['form']['upload']))					
					{
						//if(count($images) < $this->Setting->get('min_fixprice_product_image_count'))
						//{			
						//	$this->Session->setFlash(__('Yêu cầu phải có tối thiểu ' .$this->Setting->get('min_fixprice_product_image_count'). ' hình ảnh cho BĐS. Vui lòng tải thêm ảnh.', true));
							
						//}
						//else
						//{
							//Set Product State
							$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'NEW_PRODUCT');
							$this->redirect(array('action' => 'add_step3'));
						//}
						
						
					}					
					
				} else {
					if(isset($this->params['form']['upload']))					
					{
						$this->Session->setFlash(__('Không thể tải ảnh. Bạn phải điền đủ thông tin BĐS trước.', true));
					}
					else
					{
						$this->Session->setFlash(__('Không thể lưu sản phẩm. Vui lòng kiểm tra lại thông tin BĐS.', true));
					}
				}
			}     
		}

		$images = array();
		if(isset($fixprice_order['FixpriceOrder']['product_id']))
		{
			$this->data = $this->Product->read(null, $fixprice_order['FixpriceOrder']['product_id']);
			//Image list
			$images = $this->Product->ProductImage->find('all', array('conditions'=>array('ProductImage.product_id'=>$this->data["Product"]["id"])));
			
			
			foreach($utilities as $item)
			{
				$pu = $this->ProductsUtility->find('first', array("conditions"=>array("ProductsUtility.product_id"=>$this->data["Product"]["id"], "ProductsUtility.utility_id"=>$item["Utility"]["id"])));
				
				if($pu["ProductsUtility"]["value"] == 1)
				{
					//var_dump($pu);
					$uti_array[] = $pu["ProductsUtility"]["utility_id"];
				}
			}
			
			if(!isset($fixprice_ftable))
				$this->data['FixpriceGtable'] = $fixprice_order['FixpriceGtable'];
			else
				$this->data['FixpriceGtable'] = $fixprice_ftable;				
						
		}
		
		
		if(isset($this->data))
		{
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


		$this->set(compact('types', 'categories', 'cities', 'districts', 'projects', 'certificates', 'users', 'currencies', 'occupantTypes', 'utilities', 'uti_array', 'cat', 'wards', 'streets', 'images'));		
	}
	
	function add_step3($order_id = '', $email = '') {
		$this->layout = 'home';
		
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		
		$user = $this->Auth->user();
		
		
		$return_customer = true;
		if($order_id == '')
		{
			//Get current fixprice order
			if($this->Session->read("current_fixprice_order_id") == '')
			{
				$this->Session->setFlash(__('Vui lòng điền thông tin khách hàng', true));
				$this->redirect(array('action' => 'add_step1'));
			}
			$order_id = $this->Session->read("current_fixprice_order_id");
			$return_customer = false;
		}
		else
		{
			//check customer with email
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			if($fixprice_order['User']['email'] != $email)
			{
				$this->Session->setFlash(__('Truy cập không đúng', true));
				$this->redirect(array('action' => 'add_step1'));
			}
		}
		$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
		$fixprice_order['FixpriceOrder']['state'] = $this->FixpriceOrder->getState($order_id);
		
		//Create Nganluong link
		App::import('Lib', 'nganluong');
		$nganluong = new NL_Checkout();
		$checkout_link = $nganluong->buildCheckoutUrlExpand(FULL_BASE_URL.Router::url("/fixprice_orders/update_order_nl"), "account@muanhaonline.com.vn", "", $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceService"]["price"], $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = $fixprice_order["FixpriceService"]["name"], $buyer_info = '', $affiliate_code = '');
		
		
		//save product not pay
		if(isset($this->params['form']['save_later']))
		{
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['User']['email'];
						
						//Create Order link						
						$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["User"]["email"]), false);
						
						$this->set('fixprice_order', $fixprice_order);
						$this->set('checkout_link', $checkout_link);
						$this->set('order_link', $order_link);
						
						//get mail content
						$mail_content = $this->Content->read(null, 907);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						
						
						try {
						    if(!$this->SwiftMailer->send('fixprice_thankyou_email_notpaid', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
						

						
			$this->redirect(array('action' => 'add_paylater'));	
		}
		
		
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		//var_dump($fixprice_order);
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
		
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
		
		//$product["FixpriceGtable"] = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);		
		
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
		
		$this->set('fixprice_order', $fixprice_order);
		$this->set('checkout_link', $checkout_link);
		$this->set('return_customer', $return_customer);
	}
	
	function update_order_nl() {
		$this->layout = 'home';
		//echo "asdasda";
		Controller::loadModel('Content');
		Controller::loadModel('Setting');
		
		$transaction_info = $_GET['transaction_info'];
		$order_code = $_GET['order_code'];
		$price = $_GET['price'];
		$payment_id = $_GET['payment_id'];
		$payment_type = $_GET['payment_type'];
		$error_text = $_GET['error_text'];
		$secure_code = $_GET['secure_code'];
		
		//save log
		Controller::loadModel('Servicelog');
		$servicelog['Servicelog']['content'] = $_SERVER[ 'REQUEST_URI' ];
		$servicelog['Servicelog']['time'] = date('Y/m/d H:i:s');
		$this->Servicelog->create();
		$this->Servicelog->save($servicelog);
		
		//Check payment
		App::import('Lib', 'nganluong');
		$nganluong = new NL_Checkout();		
		$paid = $nganluong->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
		//echo $paid;
		//Code xac nhan thong tin thanh toán
		$order_id = $_GET['order_code'];
		//Thong tin thanh toan da duoc xac nhan
		if($paid)
		{
			//echo "okie";
			//Update order status
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			
						$fixprice_order['FixpriceOrder']['status'] = 2;						
						
						$fixprice_order['FixpriceOrder']['fixprice_payment_id'] = 1;
						$fixprice_order['FixpriceOrder']['checkout_date'] = date('Y-m-d H:i:s');
						$this->FixpriceOrder->save($fixprice_order['FixpriceOrder']);
			
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						$this->set('fixprice_order', $fixprice_order);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to customer
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['User']['email'];
						//echo $fixprice_order['FixpriceCustomer']['name'];
						//$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"]), false);
						$this->set('fixprice_order', $fixprice_order);
						//$this->set('order_link', $order_link);
						
						//get mail content
						$mail_content = $this->Content->read(null, 908);
						$link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"]), false);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						try {
						    if(!$this->SwiftMailer->send('fixprice_thankyou_email', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}					
						
						
						
						//send to admin
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $this->Setting->get('admin_email');
						
						try {
						    if(!$this->SwiftMailer->send('admin_new_fixprice_order', "Thông báo yêu cầu thẩm định mới")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
			$this->Session->delete('current_fixprice_order_id');
			
			//Set Product State						
			$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'PAID');
		}
		
	}
	
	function sms_service() {
		$this->layout = null;
		
				
		$phone_num = $this->params['url']['phone_num'];
		$service_code = $this->params['url']['service_code'];
		$service_num = $this->params['url']['service_num'];
		$order_num = $this->params['url']['order_num'];
		$time = $this->params['url']['time'];
		$secure_code = $this->params['url']['secure_code'];
		
		//echo (int)$order_num."$$";
		
		//save log
		Controller::loadModel('Servicelog');
		Controller::loadModel('Content');
		Controller::loadModel('Setting');
		$servicelog['Servicelog']['content'] = $_SERVER[ 'REQUEST_URI' ];
		$servicelog['Servicelog']['time'] = date('Y/m/d H:i:s');
		$this->Servicelog->create();
		$this->Servicelog->save($servicelog);
		
		
		//get order
		$order = $this->FixpriceOrder->read(null, (int)$order_num);
		
		//echo $phone_num."<br />".$service_code."<br />".$service_num."<br />".$order_num."<br />".$time."<br />".$secure_code."<br />".$order['FixpriceOrder']['id']."<br />";
		//echo "MD5: ".md5($phone_num.$service_code.$service_num.$order_num.$time."onlinebds#")."<br /><br /><br /><br />";
		
		$check_code = md5($phone_num.$service_code.$service_num.$order_num.$time."onlinebds#");
		
		if($service_num == '8683')
		{
			if(isset($order) && $order['FixpriceService']['id'] == 1)
			{
				
				//get state
				$order_state = $this->FixpriceOrder->getState($order['FixpriceOrder']['id']);
				
				if($order_state == 'NEW_PRODUCT')
				{
					if($check_code == $secure_code)
					{
						//Update order status
						$fixprice_order = $order;
			
						$fixprice_order['FixpriceOrder']['status'] = 2;
						
						$fixprice_order['FixpriceOrder']['fixprice_payment_id'] = 2;
						$fixprice_order['FixpriceOrder']['checkout_date'] = date('Y-m-d H:i:s');
						$this->FixpriceOrder->save($fixprice_order['FixpriceOrder']);
			
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						$this->set('fixprice_order', $fixprice_order);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to customer
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['User']['email'];
						//echo $fixprice_order['FixpriceCustomer']['name'];
						//$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"]), false);
						$this->set('fixprice_order', $fixprice_order);
						//$this->set('order_link', $order_link);
						
						//get mail content
						$mail_content = $this->Content->read(null, 908);
						$link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"]), false);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						try {
						    if(!$this->SwiftMailer->send('fixprice_thankyou_email', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}					
						
						//send to admin
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $this->Setting->get('admin_email');
						
						try {
						    if(!$this->SwiftMailer->send('admin_new_fixprice_order', "Thông báo yêu cầu thẩm định mới")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}		
						
						$this->Session->delete('current_fixprice_order_id');
						
						//Set Product State		
						$this->FixpriceOrder->setState($order['FixpriceOrder']['id'], 'PAID');						
						echo "1&Quy khach da thanh toan dich vu thanh cong. Thong tin dich vu da duoc gui qua toi Quy khach. Vui long kiem tra email ".$order['FixpriceCustomer']['email'].". Xin cam on !";
						
					}
					else
					{
						echo "0&Noi dung thanh toan khong hop le";
					}
				}
				else
				{
					echo "0&Hoa don khong o trang thai thanh toan";
				}
			}
			else
			{
				echo "0&Hoa don khong hop le";
			}
		}
		else
		{
			echo "0&Dau so cho dich vu khong hop le";
		}
		
		
		
	}
	
	function admin_setpaidnl($order_id = null) {
		
		if (!$order_id) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		Controller::loadModel('Content');
		Controller::loadModel('Setting');
		if(true)
		{
			//echo "okie";
			//Update order status
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			
						$fixprice_order['FixpriceOrder']['status'] = 2;
						$fixprice_order['FixpriceOrder']['checkout_date'] = date('Y-m-d H:i:s');
						$this->FixpriceOrder->save($fixprice_order['FixpriceOrder']);
			
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						$this->set('fixprice_order', $fixprice_order);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to customer
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['User']['email'];
						//echo $fixprice_order['FixpriceCustomer']['name'];
						$this->set('fixprice_order', $fixprice_order);
						$link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'add_step3', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"], 'admin'=>false), false);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						//$this->set('mail_content', $mail_content);
						
						//get mail content
						$mail_content = $this->Content->read(null, 908);
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						try {
						    if(!$this->SwiftMailer->send('fixprice_thankyou_email', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}					
						
						//send to admin
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $this->Setting->get('admin_email');
						
						try {
						    if(!$this->SwiftMailer->send('admin_new_fixprice_order', "Thông báo yêu cầu thẩm định mới")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
						
			//Set Product State						
			$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'PAID');
			
			$this->redirect(array('action' => 'index'));
			
		}
		$this->Session->delete('current_fixprice_order_id');
	}
	
	function add_paylater()
	{
		$this->layout = 'home';
		if($this->Session->read("current_fixprice_order_id") == '')
		{
			$this->Session->setFlash(__('Vui lòng điền thông tin khách hàng', true));
			$this->redirect(array('action' => 'add_step1'));
		}
		
		$fixprice_order = $this->FixpriceOrder->read(null, $this->Session->read("current_fixprice_order_id"));
		$this->Session->delete('current_fixprice_order_id');
		$this->set('fixprice_order', $fixprice_order);
	}
	
	function order_result($order_id = '', $customer_email = '') {
		$this->layout = 'home';
		
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('FixpriceAnswer');
		
		
		$user = $this->Auth->user();
		
		
		
		if($order_id == '')
		{
			
			$this->Session->setFlash(__('Thông tin không hợp lệ.', true));
			$this->redirect(array('action' => 'add_step1'));
			
		}
		else
		{
			//check customer with email
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			if($fixprice_order['FixpriceCustomer']['email'] != $customer_email)
			{
				$this->Session->setFlash(__('Truy cập không đúng', true));
				$this->redirect(array('action' => 'add_step1'));
			}
		}		
		
		//get state
		$state = $this->FixpriceOrder->getState($fixprice_order["FixpriceOrder"]["id"]);
		$answer = $this->FixpriceOrder->FixpriceAnswer->read(null, $fixprice_order["FixpriceAnswer"]["id"]);
		
		
		if($state != "VALID" && $state != "FINISHED_RATED")
		{
			
			$this->Session->setFlash(__('Thông tin không hợp lệ.', true));
			$this->redirect(array('action' => 'add_step1'));
			
		}
		
		if (!empty($this->data)) {
			$fixprice_order["FixpriceOrder"]["fixprice_rate_id"] = $this->data['FixpriceRate']['id'];
			$fixprice_order["FixpriceOrder"]["expert_rate"] = $this->data['FixpriceOrder']['expert_rate'];
			if ($this->FixpriceOrder->save($fixprice_order)) {
				$this->Session->setFlash(__('Phản hồi từ khách hàng đã được lưu trữ', true));				
				
				$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
				$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'FINISHED_RATED');
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice rate could not be saved. Please, try again.', true));
			}
		}
		
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		//var_dump($fixprice_order);
		
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
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
                        
                        
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		$fixprice_order["FixpriceAnswer"]["price_total"] = $fixprice_order["FixpriceAnswer"]["price_total"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_total"],0,".", ",") : "";
		$fixprice_order["FixpriceAnswer"]["price_unit"] = $fixprice_order["FixpriceAnswer"]["price_unit"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		
		//$product["FixpriceGtable"] = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);		
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		$fixpriceRates = $this->FixpriceOrder->FixpriceRate->find('list');
		$this->data['FixpriceRate']['id'] = 2;
		//$fixpriceRate = 
		//var_dump($product);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);		
		$this->set('pus', $pus);
		$this->set('fixpriceRates', $fixpriceRates );
		
		$this->set('answer', $answer );
		
		$this->set('fixprice_order', $fixprice_order);				
	}
	
	function admin_order_result($order_id = '', $customer_email = '') {
		$this->layout = 'home';
		
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('FixpriceAnswer');
		
		
		$user = $this->Auth->user();
		
		
		
		if($order_id == '')
		{
			
			$this->Session->setFlash(__('Thông tin không hợp lệ.', true));
			$this->redirect(array('action' => 'add_step1'));
			
		}
		else
		{
			//check customer with email
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			if($fixprice_order['FixpriceCustomer']['email'] != $customer_email)
			{
				$this->Session->setFlash(__('Truy cập không đúng', true));
				$this->redirect(array('action' => 'add_step1'));
			}
		}		
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		//var_dump($fixprice_order);
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
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
                        
                        
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		$fixprice_order["FixpriceAnswer"]["price_total"] = $fixprice_order["FixpriceAnswer"]["price_total"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_total"],0,".", ",") : "";
		$fixprice_order["FixpriceAnswer"]["price_unit"] = $fixprice_order["FixpriceAnswer"]["price_unit"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		
		//$product["FixpriceGtable"] = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);		
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($product);
		
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);		
		$this->set('pus', $pus);
		
		
		$this->set('fixprice_order', $fixprice_order);				
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceOrder->read(null, $id);
		}
		$userProfiles = $this->FixpriceOrder->UserProfile->find('list');
		$users = $this->FixpriceOrder->User->find('list');
		$products = $this->FixpriceOrder->Product->find('list');
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('userProfiles', 'users', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpricePayments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice order', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceOrder->delete($id)) {
			$this->Session->setFlash(__('Fixprice order deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice order was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_index() {
		$user = $this->Auth->user();
		
		//$this->FixpriceOrder->getByState('NEW');
		
		//Get all filters
		$conditions = array();
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		if($status != '' && $status != 'all')
		{
			//$conditions["FixpriceOrder.status"] = $status;
			//echo $status;
			$a_order_ids = $this->FixpriceOrder->getByState($status);
			$conditions["FixpriceOrder.id"] = $a_order_ids;
		}
		
		
		
		
		
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		
		
		foreach($fixpriceOrders as $key => $item)
		{
			if($item['FixpriceOrder']['checkout_date']) $fixpriceOrders[$key]['remain_hours'] = 24 - round((strtotime(date('Y-m-d H:i:s')) - strtotime($item['FixpriceOrder']['checkout_date']))/3600, 0);
		}
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceOrder', $this->FixpriceOrder->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FixpriceOrder->create();
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		$userProfiles = $this->FixpriceOrder->UserProfile->find('list');
		$users = $this->FixpriceOrder->User->find('list');
		$products = $this->FixpriceOrder->Product->find('list');
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('userProfiles', 'users', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpricePayments'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceOrder->read(null, $id);
		}
		$userProfiles = $this->FixpriceOrder->UserProfile->find('list');
		$users = $this->FixpriceOrder->User->find('list');
		$products = $this->FixpriceOrder->Product->find('list');
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('userProfiles', 'users', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpricePayments'));
	}
	
	function admin_assign($id = null) {
		Controller::loadModel('DistrictsExpert');
		Controller::loadModel('Content');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			$this->data['FixpriceOrder']['status'] = 3;
			$this->data['FixpriceOrder']['assign_date'] = date('Y-m-d H:i:s');
			
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				
				//Send thanks email to expert
				//Sending email
				$expert = $this->FixpriceOrder->Expert->read(null, $this->data['FixpriceOrder']['expert_id']);
				
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $expert['Expert']['email'];
						
						$this->set('fixprice_order', $this->FixpriceOrder->read(null, $id));
						$this->set('expert', $expert);
						
						//get mail content
						$mail_content = $this->Content->read(null, 909);
						$link = FULL_BASE_URL.Router::url('/admin');
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						
						try {
						    if(!$this->SwiftMailer->send('expert_new_fixprice_order', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
									
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceOrder->read(null, $id);
		}
		$fixpriceCustomers = $this->FixpriceOrder->FixpriceCustomer->find('list');
		$users = $this->FixpriceOrder->User->find('list');
		
		//get users per district
		$exs = $this->DistrictsExpert->find('all', array('conditions'=>array('DistrictsExpert.district_id'=>$this->data['Product']['district_id'])));
		$user_array = array();
		foreach($exs as $uitem)
		{
			$user_array[] = $uitem['DistrictsExpert']['expert_id'];
		}
		//var_dump($user_array);
		$experts = $this->FixpriceOrder->Expert->find('list', array('conditions'=>array('Expert.id'=>$user_array, 'Expert.group_id'=>4)));
		
		//var_dump($exs);var_dump($experts);
		//echo $this->data['Product']['district_id'];
		//var_dump($experts);
		$products = $this->FixpriceOrder->Product->find('list');
		$fixpriceTypes = $this->FixpriceOrder->FixpriceType->find('list');
		$fixpriceServices = $this->FixpriceOrder->FixpriceService->find('list');
		$fixpricePayments = $this->FixpriceOrder->FixpricePayment->find('list');
		$this->set(compact('fixpriceCustomers', 'users', 'experts', 'products', 'fixpriceTypes', 'fixpriceServices', 'fixpricePayments'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice order', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceOrder->delete($id)) {
			$this->Session->setFlash(__('Fixprice order deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice order was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_valid($id = null) {
		Controller::loadModel('Content');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice order', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$user = $this->Auth->user();		
		$fixprice_order = $this->FixpriceOrder->find('first', array('conditions'=>array(
														'FixpriceOrder.id'=>$id
													)));
		//echo $order_id;
		if (!$fixprice_order) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		
		
		if($fixprice_order['FixpriceOrder']['status'] == 4)
		{
			$fixprice_order['FixpriceOrder']['status'] = 5;
			$fixprice_order['FixpriceOrder']['publish_date'] = date('Y-m-d H:i:s');
			
			if ($this->FixpriceOrder->save($fixprice_order)) {
				$this->Session->setFlash(__('Thẩm định đã được đăng.', true));
				
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"], 'admin'=>false), false);
						
						$this->set('fixprice_order', $fixprice_order);
						$this->set('order_link', $order_link);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to customer
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['User']['email'];
						
						//get mail content
						$mail_content = $this->Content->read(null, 910);						
						$this->set('mail_content', $mail_content);						
						
						
						try {
						    if(!$this->SwiftMailer->send('fixprice_fixpriced', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}						
						
						//send to expert
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['Expert']['email'];
						//get mail content
						$mail_content = $this->Content->read(null, 911);
						$link = FULL_BASE_URL.Router::url('/admin');
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						
						
						try {
						    if(!$this->SwiftMailer->send('expert_fixprice_valid', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}	
						
				
				
				$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'VALID');
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS.', true));
			}
		}
		
		//$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_invalid($id = null) {
		Controller::loadModel('Content');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice order', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$user = $this->Auth->user();		
		$fixprice_order = $this->FixpriceOrder->find('first', array('conditions'=>array(
														'FixpriceOrder.id'=>$id
													)));
		//echo $order_id;
		if (!$fixprice_order) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		if($fixprice_order['FixpriceOrder']['status'] == 4)
		{
			$fixprice_order['FixpriceOrder']['status'] = -1;
			$fixprice_order['FixpriceOrder']['post_date'] = null;
			
			if ($this->FixpriceOrder->save($fixprice_order)) {
				$this->Session->setFlash(__('Thẩm định chưa đúng đã gửi lại CTV.', true));
				
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"], 'admin'=>false), false);
						
						$this->set('fixprice_order', $fixprice_order);
						$this->set('order_link', $order_link);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to expert
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $fixprice_order['Expert']['email'];
						//get mail content
						$mail_content = $this->Content->read(null, 912);
						$link = FULL_BASE_URL.Router::url('/admin');
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						
						
						try {
						    if(!$this->SwiftMailer->send('expert_fixprice_invalid', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}	
						
				
				$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'INVALID');
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS.', true));
			}
		}
		
		//$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function manager_index()
	{
		$user = $this->Auth->user();
		
		//Get all filters
		$conditions = array('FixpriceOrder.user_id'=>$user["User"]["id"]);
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		if($status != '' && $status != 'all')
		{
			$conditions["FixpriceOrder.status"] = $status;
		}
		
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		foreach($fixpriceOrders as $key => $item)
		{
			$state = $this->FixpriceOrder->getState($item['FixpriceOrder']['id']);
			if($state == 'NEW_PRODUCT')
			{
				$service = $this->FixpriceOrder->FixpriceService->find('first' , array('conditions'=>array('FixpriceService.id'=>$item['FixpriceOrder']['fixprice_service_id'])));
				//Create Nganluong link
				App::import('Lib', 'nganluong');
				$nganluong = new NL_Checkout();
				$checkout_link = $nganluong->buildCheckoutUrlExpand(FULL_BASE_URL.Router::url("/fixprice_orders/update_order_nl"), "account@muanhaonline.com.vn", "", $item["FixpriceOrder"]["id"], $service["FixpriceService"]["price"], $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = $service["FixpriceService"]["name"], $buyer_info = '', $affiliate_code = '');
				
				
				$fixpriceOrders[$key]['FixpriceOrder']['checkout_link'] = $checkout_link;
			}
		}
		
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
		
	}
	
	function user_index()
	{
		$user = $this->Auth->user();
		
		//Get all filters
		//$conditions = array('FixpriceOrder.user_id'=>$user["User"]["id"]);
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		
		
		if($status == '' || $status == 'all') $status = 'NEW_PRODUCT';
		
		//echo $status;		
		if($status == 'NEW_PRODUCT' || $status == 'VALID')
		{
			$a_order_ids = $this->FixpriceOrder->getByUser($status, $user['User']['id']);
		}
		else if($status == 'FINISHED_RATED')
		{
			$a_order_ids = $this->FixpriceOrder->getByUser($status, $user['User']['id']);
		}
		else
		{
			$a_order_ids = $this->FixpriceOrder->getByUser(array('PAID', 'REGISTERED', ' PRIVATE_REGISTER', 'ASSIGNED', 'EXPERT_PENDING', 'INVALID'), $user['User']['id']);
		}
		$conditions["FixpriceOrder.id"] = $a_order_ids;
		
		
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		foreach($fixpriceOrders as $key => $item)
		{
			$state = $this->FixpriceOrder->getState($item['FixpriceOrder']['id']);
			if($state == 'NEW_PRODUCT')
			{
				$service = $this->FixpriceOrder->FixpriceService->find('first' , array('conditions'=>array('FixpriceService.id'=>$item['FixpriceOrder']['fixprice_service_id'])));
				//Create Nganluong link
				App::import('Lib', 'nganluong');
				$nganluong = new NL_Checkout();
				$checkout_link = $nganluong->buildCheckoutUrlExpand(FULL_BASE_URL.Router::url("/fixprice_orders/update_order_nl"), "account@muanhaonline.com.vn", "", $item["FixpriceOrder"]["id"], $service["FixpriceService"]["price"], $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = $service["FixpriceService"]["name"], $buyer_info = '', $affiliate_code = '');
				
				
				$fixpriceOrders[$key]['FixpriceOrder']['checkout_link'] = $checkout_link;
				
				
			}
			$fixpriceOrders[$key]['FixpriceOrder']['state'] = $this->FixpriceOrder->getState($item['FixpriceOrder']['id']);
		}
		
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
		
	}
	
	function expert_index() {
		Controller::loadModel('Setting');
		$user = $this->Auth->user();
		
		$isLeader = $this->FixpriceOrder->isLeader($user['User']['id']);
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		if($status == '' || $status == 'all') $status = 'PAID';
		
		//echo $status;
		
		if($status == 'PAID')
		{
			$a_order_ids = $this->FixpriceOrder->getByState($status);
		}
		else if($status == 'REGISTERED')
		{
			$a_order_ids = $this->FixpriceOrder->getByGroupLeader($user['User']['id'], $status);
		}
		else if($status == 'ASSIGNED_LEAD')
		{
			$a_order_ids = $this->FixpriceOrder->getByGroupLeader($user['User']['id'], array('ASSIGNED'));
		}
		else if($status == 'ASSIGNED' || $status == 'EXPERT_PENDING' || $status == 'VALID' || $status == 'INVALID')
		{
			$a_order_ids = $this->FixpriceOrder->getByExpert($user['User']['id'], $status);
		}
		else
		{
			$a_order_ids = $this->FixpriceOrder->getByExpert($user['User']['id'], $status);
		}
		
		
		$conditions["FixpriceOrder.id"] = $a_order_ids;
		
		
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		$public_register_time = $this->Setting->get('public_fixpriceorder_register_time');
		$private_assign_time = $this->Setting->get('private_fixpriceorder_assign_time');
		$private_expert_fixprice_time = $this->Setting->get('private_expert_fixprice_time');
		//$private_expert_fixprice_time = $this->Setting->get('private_expert_fixprice_time');
		$private_expert_invalid_refix_time = $this->Setting->get('private_expert_invalid_refix_time');
		
		foreach($fixpriceOrders as $key => $item)
		{
			$state = $this->FixpriceOrder->getState($item['FixpriceOrder']['id'], true);
			$fixpriceOrders[$key]['FixpriceOrderState'] = $state['FixpriceOrderState'];
			
			if($state['FixpriceOrderState']['alias'] == 'PAID')
			{
				$remain_hours = round(($public_register_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}			
			else if($state['FixpriceOrderState']['alias'] == 'REGISTERED')
			{
				$remain_hours = round(($private_assign_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else if($state['FixpriceOrderState']['alias'] == 'ASSIGNED')
			{
				$remain_hours = round(($private_expert_fixprice_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else if($state['FixpriceOrderState']['alias'] == 'VALID')
			{
				//$remain_hours = round(($private_expert_fixprice_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = "hoàn thành...";			
			}
			else if($state['FixpriceOrderState']['alias'] == 'INVALID')
			{
				$remain_hours = round(($private_expert_invalid_refix_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else
			{
				$fixpriceOrders[$key]['remain_hours'] = "......";	
			}
			//var_dump($state);
		}
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
		$this->set('isLeader', $isLeader);
	}
	
	function expert_view($order_id) {
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		
		if (!$order_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$user = $this->Auth->user();
		
		
		$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
		
		$state = $this->FixpriceOrder->getState($fixprice_order["FixpriceOrder"]["id"]);
		$answer = $this->FixpriceOrder->FixpriceAnswer->read(null, $fixprice_order["FixpriceAnswer"]["id"]);
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		$fixprice_order["FixpriceAnswer"]["price_total"] = number_format($fixprice_order["FixpriceAnswer"]["price_total"],0,".", ",");
		$fixprice_order["FixpriceAnswer"]["price_unit"] = number_format($fixprice_order["FixpriceAnswer"]["price_unit"],0,".", ",");
		
		//var_dump($fixprice_order);
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			//$this->redirect(array('action' => 'index'));
		}
		$product = $this->Product->read(null, $id);
		
		
		
		//Price
		Controller::loadModel('Currency');
		if($product["Product"]["price"]) {
			if($product['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($product['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";			
			
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
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		//$product["FixpriceGtable"] = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);		
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($product);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('profile', $profile);
		$this->set('user', $user);
		$this->set('pus', $pus);
		$this->set('answer', $answer);
		$this->set('state', $state);
		$this->set('fixprice_order', $fixprice_order);
	}
	
	function expert_postanswer($fixprice_order_id) {
		if (!$fixprice_order_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		Controller::loadModel('Setting');
		$user = $this->Auth->user();		
		$fixpriceOrder = $this->FixpriceOrder->find('first', array('conditions'=>array(
														'FixpriceOrder.id'=>$fixprice_order_id,
														'FixpriceOrder.expert_id'=>$user['User']['id']
													)));
		//var_dump($fixpriceOrder);
		//echo $order_id;
		if (!$fixpriceOrder) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
			//return;
		}
		
		//check if answered
		if(!$this->FixpriceOrder->checkAnswer($fixpriceOrder['FixpriceOrder']['id']))
		{
			$this->Session->setFlash(__('Thẩm định yêu cầu chưa đầy đủ. Bổ sung các mục còn thiếu.', true));
			$this->redirect(array('controller'=>'fixprice_answers','action' => 'add', $fixpriceOrder['FixpriceOrder']['id']));
		}
		//echo $this->FixpriceOrder->checkAnswer($fixpriceOrder['FixpriceOrder']['id']);
		//return;
			
		//Trang thái yêu cầu
		$order_state = $this->FixpriceOrder->getState($fixpriceOrder['FixpriceOrder']['id']);
		
		
		
		if($order_state == 'ASSIGNED' || $order_state == 'INVALID')
		{
			$fixpriceOrder['FixpriceOrder']['status'] = 4;
			
			$fixpriceOrder['FixpriceOrder']['post_date'] = date('Y-m-d H:i:s');
			
			//echo "sdfsdfsf";
			
			if ($this->FixpriceOrder->save($fixpriceOrder)) {
				$this->Session->setFlash(__('Thẩm định đã được đăng. Vui lòng đợi kết quả', true));
				
				$this->FixpriceOrder->setState($fixpriceOrder['FixpriceOrder']['id'], 'EXPERT_PENDING');
				
				
						//Send thanks email to customer
						//Sending email						
						$this->SwiftMailer->smtpType = 'ssl';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 465;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
						
						
						
						$this->set('fixprice_order', $fixpriceOrder);
						//$this->set('order_link', $order_link);
						
						$this->SwiftMailer->sendAs = 'html';
						
						//send to admin
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $this->Setting->get('admin_email');				
						try {
						    if(!$this->SwiftMailer->send('admin_new_fixprice_post', "Có trả lời thẩm định mới - MuaNhaOnline.com.vn")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
				
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Lỗi trong quá trình đăng thẩm định.', true));
			}
		}
	}
	
	function expert_resorder($id = null)
	{
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$state = $this->FixpriceOrder->getState($id);
		$order = $this->FixpriceOrder->read(null, $id);		
		$user = $this->Auth->user();		
		$expertGroups = $this->FixpriceOrder->ExpertGroup->find('list', array('conditions'=>array('ExpertGroup.expert_id'=>$user['User']['id'])));
		
		if(!count($expertGroups))
		{
			$this->Session->setFlash(__('Không phải trưởng nhóm', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if($state == 'PAID') {
				if ($this->FixpriceOrder->save($this->data)) {				
					$this->FixpriceOrder->setState($id, 'REGISTERED', 'auto');
					$this->Session->setFlash(__('Đăng ký thẩm định cho nhóm thành công. Nhóm trưởng tiến hành bàn giao cho CTV ngay khi có thể', true));
				
					$this->redirect(array('action' => 'assign', $this->data['FixpriceOrder']['id']));
				} else {
					$this->Session->setFlash(__('Không thể đăng ký yều thầm định.', true));
				}
			}
			else
			{
				$this->Session->setFlash(__('Bạn không thể đăng ký yêu cầu này.', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		else
		{
			$this->data = $this->FixpriceOrder->read(null, $id);
		}
		
		$this->set(compact('expertGroups'));
	}
	
	function expert_assign($id = null) {
		Controller::loadModel('DistrictsExpert');
		Controller::loadModel('Content');
		
		$user = $this->Auth->user();
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			//var_dump($this->data);
			//return;
			
			if(!isset($this->data['FixpriceOrder']['expert_id']))
			{
				$this->Session->setFlash(__('Phải chọn thành viên thực hiện yêu cầu', true));
				$this->redirect(array('action' => 'assign', $id));
			}
			
			$this->data['FixpriceOrder']['status'] = 3;
			$this->data['FixpriceOrder']['assign_date'] = date('Y-m-d H:i:s');
			
			if ($this->FixpriceOrder->save($this->data)) {
				$this->Session->setFlash(__('The fixprice order has been saved', true));
				
				//Set Product State
				$this->FixpriceOrder->setState($this->FixpriceOrder->id, 'ASSIGNED', $this->data['FixpriceOrdersState']['note']);
				
				//Send thanks email to expert
				//Sending email
				$expert = $this->FixpriceOrder->Expert->read(null, $this->data['FixpriceOrder']['expert_id']);
				
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = "info@muanhaonline.com.vn";
						$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
						$this->SwiftMailer->to = $expert['Expert']['email'];
						
						$this->set('fixprice_order', $this->FixpriceOrder->read(null, $id));
						$this->set('expert', $expert);
						
						//get mail content
						$mail_content = $this->Content->read(null, 909);
						$link = FULL_BASE_URL.Router::url('/admin');
						//preg_match('/{title}(.*?){\/title}/', $mail_content['Content']['content'], $title);
						$this->set('mail_content', $mail_content);
						$this->set('link', $link);
						
						
						try {
						    if(!$this->SwiftMailer->send('expert_new_fixprice_order', $mail_content['Content']['name'])) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
									
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceOrder->read(null, $id);
			$product = $this->FixpriceOrder->Product->read(null, $this->data['Product']['id']);
			$this->data['Product']['name'] = $this->data['FixpriceService']['name']." -- ".$product['Product']['home_number']." ".$product['Street']['name'].", ".$product['Ward']['name'].", ".$product['District']['name'].", ".$product['City']['name'];
		}
		
		$group = $this->FixpriceOrder->ExpertGroup->find('first', array('conditions'=>array('ExpertGroup.id'=>$this->data['ExpertGroup']['id'])));
		
		$experts = array();
		foreach($group['User'] as $key => $u)
		{
			$tt = $this->FixpriceOrder->getExpertStatus($u['id']);
			$experts[$u['id']] = $u['username']." (đang thực hiện ".$tt." yêu cầu)";
		}
		
		$this->set(compact('experts'));
	}
	
	function supervisor_index()
	{
		Controller::loadModel('Setting');
		$user = $this->Auth->user();
		
		//Get all filters
		$conditions = array();
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		if($status == '' || $status == 'all') $status = 'PAID';
		
		if($status != '' && $status != 'all')
		{
			//$conditions["FixpriceOrder.status"] = $status;
			//echo $status;
			$a_order_ids = $this->FixpriceOrder->getByState($status);
			//echo count($this->FixpriceOrder->getByState($status));
			$conditions["FixpriceOrder.id"] = $a_order_ids;			
		}
				
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		
		$public_register_time = $this->Setting->get('public_fixpriceorder_register_time');
		$private_assign_time = $this->Setting->get('private_fixpriceorder_assign_time');
		$private_expert_fixprice_time = $this->Setting->get('private_expert_fixprice_time');
		//$private_expert_fixprice_time = $this->Setting->get('private_expert_fixprice_time');
		$private_expert_invalid_refix_time = $this->Setting->get('private_expert_invalid_refix_time');
		$inspector_expert_pending = $this->Setting->get('inspector_expert_pending');
		
		foreach($fixpriceOrders as $key => $item)
		{
			//if($item['FixpriceOrder']['checkout_date']) $fixpriceOrders[$key]['remain_hours'] = 24 - round((strtotime(date('Y-m-d H:i:s')) - strtotime($item['FixpriceOrder']['checkout_date']))/3600, 0);
			
			
			$state = $this->FixpriceOrder->getState($item['FixpriceOrder']['id'], true);
			
			if($state['FixpriceOrderState']['alias'] == 'PAID')
			{
				$remain_hours = round(($public_register_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}			
			else if($state['FixpriceOrderState']['alias'] == 'REGISTERED')
			{
				$remain_hours = round(($private_assign_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else if($state['FixpriceOrderState']['alias'] == 'ASSIGNED')
			{
				$remain_hours = round(($private_expert_fixprice_time - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else if($state['FixpriceOrderState']['alias'] == 'EXPERT_PENDING')
			{
				$remain_hours = round(($inspector_expert_pending - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}
			else
			{
				$fixpriceOrders[$key]['remain_hours'] = "......";	
			}
			
			$product = $this->FixpriceOrder->Product->read(null, $item['Product']['id']);
			$fixpriceOrders[$key]['Product']['name_title'] = $item['FixpriceService']['name']." -- ".$product['Product']['home_number']." ".$product['Street']['name'].", ".$product['Ward']['name'].", ".$product['District']['name'].", ".$product['City']['name'];
		}
		
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
	}
	
	function inspector_index()
	{
		Controller::loadModel('Setting');
		$user = $this->Auth->user();
		
		//Get all filters
		$conditions = array();
		
		//filter product published		
		if(!empty($this->params['form']['filter_status']) || (isset($this->params['form']['filter_status']) && $this->params['form']['filter_status'] == 0))
		{
			$status = $this->params['form']['filter_status'];
		}
		else
			$status = $this->Session->read("filter_status");
		
		$this->Session->write("filter_status", $status);
		
		if($status == '' || $status == 'all') $status = 'EXPERT_PENDING';
		
		if($status != '' && $status != 'all')
		{
			//$conditions["FixpriceOrder.status"] = $status;
			//echo $status;
			$a_order_ids = $this->FixpriceOrder->getByState($status);
			$conditions["FixpriceOrder.id"] = $a_order_ids;
		}
				
		$this->paginate = array('conditions'=>$conditions);
		$fixpriceOrders = $this->paginate();
		
		$inspector_expert_pending = $this->Setting->get('inspector_expert_pending');
		
		foreach($fixpriceOrders as $key => $item)
		{
			if($item['FixpriceOrder']['checkout_date']) $fixpriceOrders[$key]['remain_hours'] = 24 - round((strtotime(date('Y-m-d H:i:s')) - strtotime($item['FixpriceOrder']['checkout_date']))/3600, 0);
			
			
			$state = $this->FixpriceOrder->getState($item['FixpriceOrder']['id'], true);
			$fixpriceOrders[$key]['FixpriceOrderState'] = $state['FixpriceOrderState'];
			
			if($state['FixpriceOrderState']['alias'] == 'EXPERT_PENDING')
			{
				$remain_hours = round(($inspector_expert_pending - (strtotime(date('Y-m-d H:i:s')) - strtotime($state['FixpriceOrdersState']['created_date'])))/3600, 2);
				$fixpriceOrders[$key]['remain_hours'] = $remain_hours." tiếng";			
			}				
			else
			{
				$fixpriceOrders[$key]['remain_hours'] = "......";	
			}
		}
		
		$this->FixpriceOrder->recursive = 0;
		$this->set('fixpriceOrders', $fixpriceOrders);
		$this->set('status', $status);
	}
	
	function inspector_order_result($order_id = '', $customer_email = '') {
		$this->layout = 'home';
		
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('FixpriceAnswer');
		
		
		$user = $this->Auth->user();
		
		
		
		if($order_id == '')
		{
			
			$this->Session->setFlash(__('Thông tin không hợp lệ.', true));
			$this->redirect(array('action' => 'add_step1','inspector'=>false));
			
		}
		else
		{
			//check customer with email
			$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
			if($fixprice_order['FixpriceCustomer']['email'] != $customer_email)
			{
				$this->Session->setFlash(__('Truy cập không đúng', true));
				$this->redirect(array('action' => 'add_step1','inspector'=>false));
			}
		}
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		
		$answer = $this->FixpriceAnswer->read(null, $fixprice_order['FixpriceAnswer']['id']);
		
		$state = $this->FixpriceOrder->getState($fixprice_order["FixpriceOrder"]["id"]);
		if($state != 'EXPERT_PENDING')
		{
			$this->Session->setFlash(__('Thẩm định không ở trạng thái đợi duyệt.', true));
			$this->redirect(array('action' => 'index'));	
		}
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
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
                        
                        
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		$fixprice_order["FixpriceAnswer"]["price_total"] = $fixprice_order["FixpriceAnswer"]["price_total"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_total"],0,".", ",") : "";
		$fixprice_order["FixpriceAnswer"]["price_unit"] = $fixprice_order["FixpriceAnswer"]["price_unit"] != '' ? number_format($fixprice_order["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		
		//$product["FixpriceGtable"] = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);		
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($product);
		
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);		
		$this->set('pus', $pus);
		$this->set('answer', $answer);
		
		
		$this->set('fixprice_order', $fixprice_order);				
	}
	
	function inspector_valid($id = null) {
		Controller::loadModel('Content');
		
		if (!empty($this->data)) {
			$id = $this->data['FixpriceOrder']['id'];
			
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for fixprice order', true));
				$this->redirect(array('action'=>'index'));
			}
			
			$user = $this->Auth->user();		
			$fixprice_order = $this->FixpriceOrder->find('first', array('conditions'=>array(
															'FixpriceOrder.id'=>$id
														)));
			//echo $order_id;
			if (!$fixprice_order) {
				$this->Session->setFlash(__('Invalid fixprice order', true));
				$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
			}
			
			$state = $this->FixpriceOrder->getState($fixprice_order['FixpriceOrder']['id']);
			
			if($state == 'EXPERT_PENDING')
			{
				$fixprice_order['FixpriceOrder']['status'] = 5;
				$fixprice_order['FixpriceOrder']['publish_date'] = date('Y-m-d H:i:s');
				
				if ($this->FixpriceOrder->save($fixprice_order)) {
					$this->Session->setFlash(__('Thẩm định đã được đăng.', true));
					
							//Send thanks email to customer
							//Sending email						
							$this->SwiftMailer->smtpType = 'tls';
							$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
							$this->SwiftMailer->smtpPort = 587;
							$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
							$this->SwiftMailer->smtpPassword = 'bdsonline$';
							
							$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"], 'admin'=>false), false);
							
							$this->set('fixprice_order', $fixprice_order);
							$this->set('order_link', $order_link);
							
							$this->SwiftMailer->sendAs = 'html';
							
							//send to customer
							$this->SwiftMailer->from = "info@muanhaonline.com.vn";
							$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
							$this->SwiftMailer->to = $fixprice_order['User']['email'];
							
							//get mail content
							$mail_content = $this->Content->read(null, 910);						
							$this->set('mail_content', $mail_content);						
							
							
							try {
							    if(!$this->SwiftMailer->send('fixprice_fixpriced', $mail_content['Content']['name'])) {
								$this->log("Error sending email");							
							    }
							}
							catch(Exception $e) {
							      $this->log("Failed to send email: ".$e->getMessage());
							      $error = "failed".$e->getMessage();
							      $this->Session->setFlash($e->getMessage());
							}						
							
							//send to expert
							$this->SwiftMailer->from = "info@muanhaonline.com.vn";
							$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
							$this->SwiftMailer->to = $fixprice_order['Expert']['email'];
							//get mail content
							$mail_content = $this->Content->read(null, 911);
							$link = FULL_BASE_URL.Router::url('/admin');
							$this->set('mail_content', $mail_content);
							$this->set('link', $link);
							
							
							
							try {
							    if(!$this->SwiftMailer->send('expert_fixprice_valid', $mail_content['Content']['name'])) {
								$this->log("Error sending email");							
							    }
							}
							catch(Exception $e) {
							      $this->log("Failed to send email: ".$e->getMessage());
							      $error = "failed".$e->getMessage();
							      $this->Session->setFlash($e->getMessage());
							}	
							
					
					
					$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'VALID', $this->data['FixpriceOrdersState']['note']);
					
					//$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS.', true));
				}
			}
			
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	function inspector_invalid($id = null) {
		Controller::loadModel('Content');
		
		if (!empty($this->data)) {
			$id = $this->data['FixpriceOrder']['id'];
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for fixprice order', true));
				$this->redirect(array('action'=>'index'));
			}
			
			$user = $this->Auth->user();		
			$fixprice_order = $this->FixpriceOrder->find('first', array('conditions'=>array(
															'FixpriceOrder.id'=>$id
														)));
			//echo $order_id;
			if (!$fixprice_order) {
				$this->Session->setFlash(__('Invalid fixprice order', true));
				$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
			}
			
			$state = $this->FixpriceOrder->getState($fixprice_order['FixpriceOrder']['id']);
			
			if($state == 'EXPERT_PENDING')
			{
				$fixprice_order['FixpriceOrder']['status'] = -1;
				$fixprice_order['FixpriceOrder']['post_date'] = null;
				
				if ($this->FixpriceOrder->save($fixprice_order)) {
					$this->Session->setFlash(__('Thẩm định chưa đúng đã gửi lại CTV.', true));
					
							//Send thanks email to customer
							//Sending email						
							$this->SwiftMailer->smtpType = 'tls';
							$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
							$this->SwiftMailer->smtpPort = 587;
							$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
							$this->SwiftMailer->smtpPassword = 'bdsonline$';
							
							$order_link = FULL_BASE_URL.Router::url(array('controller'=>'fixprice_orders', 'action'=>'order_result', $fixprice_order["FixpriceOrder"]["id"], $fixprice_order["FixpriceCustomer"]["email"], 'admin'=>false), false);
							
							$this->set('fixprice_order', $fixprice_order);
							$this->set('order_link', $order_link);
							
							$this->SwiftMailer->sendAs = 'html';
							
							//send to expert
							$this->SwiftMailer->from = "info@muanhaonline.com.vn";
							$this->SwiftMailer->fromName = "MuaNhaOnline.com.vn";
							$this->SwiftMailer->to = $fixprice_order['Expert']['email'];
							//get mail content
							$mail_content = $this->Content->read(null, 912);
							$link = FULL_BASE_URL.Router::url('/admin');
							$this->set('mail_content', $mail_content);
							$this->set('link', $link);
							
							
							
							try {
							    if(!$this->SwiftMailer->send('expert_fixprice_invalid', $mail_content['Content']['name'])) {
								$this->log("Error sending email");							
							    }
							}
							catch(Exception $e) {
							      $this->log("Failed to send email: ".$e->getMessage());
							      $error = "failed".$e->getMessage();
							      $this->Session->setFlash($e->getMessage());
							}	
							
					
					$this->FixpriceOrder->setState($fixprice_order['FixpriceOrder']['id'], 'INVALID');
					
					
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS.', true));
				}
			}
		}
		//$this->Session->setFlash(__('Lỗi trong quá trình duyệt BĐS', true));
		$this->redirect(array('action' => 'index'));
	}
}
