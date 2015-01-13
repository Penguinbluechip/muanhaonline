<?php
class FixpriceAnswersController extends AppController {

	var $name = 'FixpriceAnswers';

	function expert_index() {
		$this->FixpriceAnswer->recursive = 0;
		$this->set('fixpriceAnswers', $this->paginate());
	}

	function expert_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fixprice answer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fixpriceAnswer', $this->FixpriceAnswer->read(null, $id));
	}

	function expert_add($fixprice_order_id) {
		if (!$fixprice_order_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		$user = $this->Auth->user();		
		$fixpriceOrder = $this->FixpriceAnswer->FixpriceOrder->find('first', array('conditions'=>array(
														'FixpriceOrder.id'=>$fixprice_order_id,
														'FixpriceOrder.expert_id'=>$user['User']['id']
													)));
		//echo $order_id;
		if (!$fixpriceOrder) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		
		$order_state = $this->FixpriceAnswer->FixpriceOrder->getState($fixpriceOrder['FixpriceOrder']['id']);
				
		if ($order_state != 'EXPERT_CONFIRMED' && $order_state != 'INVALID') {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		Controller::loadModel('FixpriceGtable');
		
		if (!empty($this->data)) {
			
			$this->data['FixpriceAnswer']['fixprice_order_id'] = $fixprice_order_id;
			$this->data['FixpriceAnswer']['price_total'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_total']);
			$this->data['FixpriceAnswer']['price_unit'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_unit']);
			
			//$this->data['FixpriceAnswer']['price_unit'] = $this->data['FixpriceAnswer']['price_unit'] == '' ? 0 : $this->data['FixpriceAnswer']['price_unit'];
			//$this->data['FixpriceAnswer']['price_total'] = $this->data['FixpriceAnswer']['price_total'] == '' ? 0 : $this->data['FixpriceAnswer']['price_total'];
			
			
			
			//var_dump($this->data);
			
			if(isset($fixpriceOrder['FixpriceAnswer']['id']))
			{
				$this->data['FixpriceAnswer']['id'] = $fixpriceOrder['FixpriceAnswer']['id'];
			}
			else
			{
				$this->data['FixpriceAnswer']['create_date'] = date('Y-m-d H:i:s');
				$this->FixpriceAnswer->create();
			}
			
			if ($this->FixpriceAnswer->save($this->data)) {
				
				
				foreach($this->data['FixpriceAnswerCompareitem'] as $citem)
				{
					//var_dump();
					$ccitem['FixpriceAnswerCompareitem'] = $citem;
					$ccitem['FixpriceAnswerCompareitem']['fixprice_answer_id'] = $this->FixpriceAnswer->id;
					//var_dump($ccitem);
					if(!isset($citem['id']))
					{
						if($citem['value1'].$citem['value2'].$citem['value3'].$citem['value4'].$citem['value5'].$citem['value6'].$citem['value7'].$citem['value8'].$citem['value9'].$citem['value10'] != '')
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->create();
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->save($ccitem);
						}
					}
					else
					{
						if($citem['value1'].$citem['value2'].$citem['value3'].$citem['value4'].$citem['value5'].$citem['value6'].$citem['value7'].$citem['value8'].$citem['value9'].$citem['value10'] == '')
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->delete($citem['id']);
						}
						else
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->save($ccitem);
						}
					}
				}
				
				//save gtable
				$this->FixpriceGtable->save($this->data);
				
				if(isset($this->params['form']['postanswer']))
				{
					$this->redirect(array('controller'=>'fixprice_orders','action' => 'postanswer', $fixpriceOrder['FixpriceOrder']['id']));
				}
				else
				{
					$this->Session->setFlash(__('Thông tin thẩm định đã được lưu', true));
					$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
				}				
			} else {
				$this->Session->setFlash(__('The fixprice answer could not be saved. Please, try again.', true));
			}
		}
		
		$fixpriceAnswer = $this->FixpriceAnswer->find('first', array('conditions'=>array(
														'FixpriceAnswer.fixprice_order_id'=>$fixprice_order_id
													)));
		//var_dump($fixpriceAnswer);
		if($fixpriceAnswer)
		{
			$this->data['FixpriceAnswer'] = $fixpriceAnswer['FixpriceAnswer'];
			$this->data['FixpriceAnswerCompareitem'] = $fixpriceAnswer['FixpriceAnswerCompareitem'];
		}
		
		//var_dump($this->data['FixpriceAnswerCompareitem']);
		
		$this->data['FixpriceGtable'] = $fixpriceOrder['FixpriceGtable'];
		
		if(isset($this->data["FixpriceAnswer"]["price_total"]) && $this->data["FixpriceAnswer"]["price_unit"])
		{
			$this->data["FixpriceAnswer"]["price_total"] = $this->data["FixpriceAnswer"]["price_total"] != '' ? number_format($this->data["FixpriceAnswer"]["price_total"],0,".", ",") : "";
			$this->data["FixpriceAnswer"]["price_unit"] = $this->data["FixpriceAnswer"]["price_unit"] != '' ? number_format($this->data["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		}
		
		if(!isset($this->data["FixpriceAnswer"]["relate_items"]))
		{
			$this->data["FixpriceAnswer"]["relate_items"] = '<table width="100%" border="0">
<tbody>
<tr>
<td align="center" width="150px"><strong>TH&Ocirc;NG TIN</strong></td>
<td align="center"><strong>TSSS 1</strong></td>
<td align="center"><strong>TSSS 2</strong></td>
<td align="center"><strong>TSSS 3</strong></td>
</tr>
<tr>
<td><strong>Địa chỉ t&agrave;i sản</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Điện thoại li&ecirc;n hệ</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Ph&aacute;p l&iacute;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>M&ocirc; tả</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Diện t&iacute;ch đất<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Diện t&iacute;ch sử dụng<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Đơn gi&aacute; quyền sử dụng đất<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; trị c&ocirc;ng tr&igrave;nh x&acirc;y dựng<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; rao b&aacute;n<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; thực ước t&iacute;nh<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>';
		}
		
		$fixpriceOrders = $this->FixpriceAnswer->FixpriceOrder->find('list');
		$this->set(compact('fixpriceOrders', 'fixprice_order_id'));
		
		
		
		//////////////////////////////////////////Show product
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('FixpriceOrder');
		
		$order_id = $fixprice_order_id;
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
			$return_customer = false;
		}		
		$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		//var_dump($fixprice_order);
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		$product = $this->Product->read(null, $id);
		if (!$product) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
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
                        
                        
		
		
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		if(isset($product["FixpriceOrder"]['id'])) $gtable = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);
		if(isset($gtable))
			$product["FixpriceGtable"] = $gtable;
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($this->data);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);
		if(isset($this->data['FixpriceAnswerCompareitem'])) $this->set('comparelist', $this->data['FixpriceAnswerCompareitem']);
		$this->set('pus', $pus);
		
		$this->set('fixprice_order', $fixprice_order);
		
		$this->set('return_customer', $return_customer);
	}
	
	function inspector_add($fixprice_order_id) {
		if (!$fixprice_order_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		$user = $this->Auth->user();		
		$fixpriceOrder = $this->FixpriceAnswer->FixpriceOrder->find('first', array('conditions'=>array(
														'FixpriceOrder.id'=>$fixprice_order_id
													)));
		//echo $order_id;
		if (!$fixpriceOrder) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		
		$order_state = $this->FixpriceAnswer->FixpriceOrder->getState($fixpriceOrder['FixpriceOrder']['id']);
				
		if ($order_state != 'INSPECTOR_CONFIRMED') {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		Controller::loadModel('FixpriceGtable');
		
		if (!empty($this->data)) {
			
			$this->data['FixpriceAnswer']['fixprice_order_id'] = $fixprice_order_id;
			$this->data['FixpriceAnswer']['price_total'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_total']);
			$this->data['FixpriceAnswer']['price_unit'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_unit']);
			
			//$this->data['FixpriceAnswer']['price_unit'] = $this->data['FixpriceAnswer']['price_unit'] == '' ? 0 : $this->data['FixpriceAnswer']['price_unit'];
			//$this->data['FixpriceAnswer']['price_total'] = $this->data['FixpriceAnswer']['price_total'] == '' ? 0 : $this->data['FixpriceAnswer']['price_total'];
			
			
			
			//var_dump($this->data);
			
			if(isset($fixpriceOrder['FixpriceAnswer']['id']))
			{
				$this->data['FixpriceAnswer']['id'] = $fixpriceOrder['FixpriceAnswer']['id'];
			}
			else
			{
				$this->data['FixpriceAnswer']['create_date'] = date('Y-m-d H:i:s');
				$this->FixpriceAnswer->create();
			}
			
			if ($this->FixpriceAnswer->save($this->data)) {
				
				
				foreach($this->data['FixpriceAnswerCompareitem'] as $citem)
				{
					//var_dump();
					$ccitem['FixpriceAnswerCompareitem'] = $citem;
					$ccitem['FixpriceAnswerCompareitem']['fixprice_answer_id'] = $this->FixpriceAnswer->id;
					//var_dump($ccitem);
					if(!isset($citem['id']))
					{
						if($citem['value1'].$citem['value2'].$citem['value3'].$citem['value4'].$citem['value5'].$citem['value6'].$citem['value7'].$citem['value8'].$citem['value9'].$citem['value10'] != '')
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->create();
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->save($ccitem);
						}
					}
					else
					{
						if($citem['value1'].$citem['value2'].$citem['value3'].$citem['value4'].$citem['value5'].$citem['value6'].$citem['value7'].$citem['value8'].$citem['value9'].$citem['value10'] == '')
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->delete($citem['id']);
						}
						else
						{
							$this->FixpriceAnswer->FixpriceAnswerCompareitem->save($ccitem);
						}
					}
				}
				
				//save gtable
				$this->FixpriceGtable->save($this->data);
				
				if(isset($this->params['form']['postanswer']))
				{
					$this->redirect(array('controller'=>'fixprice_orders','action' => 'publish', $fixpriceOrder['FixpriceOrder']['id']));
				}
				else
				{
					$this->Session->setFlash(__('Thông tin thẩm định đã được lưu', true));
					$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
				}				
			} else {
				$this->Session->setFlash(__('The fixprice answer could not be saved. Please, try again.', true));
			}
		}
		
		$fixpriceAnswer = $this->FixpriceAnswer->find('first', array('conditions'=>array(
														'FixpriceAnswer.fixprice_order_id'=>$fixprice_order_id
													)));
		//var_dump($fixpriceAnswer);
		if($fixpriceAnswer)
		{
			$this->data['FixpriceAnswer'] = $fixpriceAnswer['FixpriceAnswer'];
			$this->data['FixpriceAnswerCompareitem'] = $fixpriceAnswer['FixpriceAnswerCompareitem'];
		}
		
		//var_dump($this->data['FixpriceAnswerCompareitem']);
		
		$this->data['FixpriceGtable'] = $fixpriceOrder['FixpriceGtable'];
		
		if(isset($this->data["FixpriceAnswer"]["price_total"]) && $this->data["FixpriceAnswer"]["price_unit"])
		{
			$this->data["FixpriceAnswer"]["price_total"] = $this->data["FixpriceAnswer"]["price_total"] != '' ? number_format($this->data["FixpriceAnswer"]["price_total"],0,".", ",") : "";
			$this->data["FixpriceAnswer"]["price_unit"] = $this->data["FixpriceAnswer"]["price_unit"] != '' ? number_format($this->data["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		}
		
		if(!isset($this->data["FixpriceAnswer"]["relate_items"]))
		{
			$this->data["FixpriceAnswer"]["relate_items"] = '<table width="100%" border="0">
<tbody>
<tr>
<td align="center" width="150px"><strong>TH&Ocirc;NG TIN</strong></td>
<td align="center"><strong>TSSS 1</strong></td>
<td align="center"><strong>TSSS 2</strong></td>
<td align="center"><strong>TSSS 3</strong></td>
</tr>
<tr>
<td><strong>Địa chỉ t&agrave;i sản</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Điện thoại li&ecirc;n hệ</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Ph&aacute;p l&iacute;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>M&ocirc; tả</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Diện t&iacute;ch đất<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Diện t&iacute;ch sử dụng<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Đơn gi&aacute; quyền sử dụng đất<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; trị c&ocirc;ng tr&igrave;nh x&acirc;y dựng<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; rao b&aacute;n<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Gi&aacute; thực ước t&iacute;nh<br /></strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>';
		}
		
		$fixpriceOrders = $this->FixpriceAnswer->FixpriceOrder->find('list');
		$this->set(compact('fixpriceOrders', 'fixprice_order_id'));
		
		
		
		//////////////////////////////////////////Show product
		Controller::loadModel('Product');
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		Controller::loadModel('ProductsUtility');
		Controller::loadModel('FixpriceOrder');
		
		$order_id = $fixprice_order_id;
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
			$return_customer = false;
		}		
		$fixprice_order = $this->FixpriceOrder->read(null, $order_id);
		
		$fixprice_order["FixpriceService"]["price"] = number_format($fixprice_order["FixpriceService"]["price"],0,".", ",");
		//var_dump($fixprice_order);
		
		$id = $fixprice_order['FixpriceOrder']['product_id'];
		//echo $id;
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		$product = $this->Product->read(null, $id);
		if (!$product) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
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
                        
                        
		
		
		
		//utilities
		$pus = $this->ProductsUtility->find('all', array('conditions'=>array('ProductsUtility.product_id'=>$product["Product"]["id"])));
		//var_dump($pus);
		
		//format date
		$product["Product"]["ncreate_date"] = $product["Product"]["create_date"];
		$product["Product"]["create_date"] = parent::dateFormat($product["Product"]["create_date"]);
		
		if(isset($product["FixpriceOrder"]['id'])) $gtable = $this->FixpriceOrder->FixpriceGtable->read(null, $product["FixpriceOrder"]['id']);
		if(isset($gtable))
			$product["FixpriceGtable"] = $gtable;
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$product["User"]["id"])));
		$product["ProductComment"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'0'),'order'=>'ProductComment.create_date DESC'));
		$product["ProductCommentE"] = $this->Product->ProductComment->find('all', array('conditions'=>array('ProductComment.product_id'=>$product["Product"]["id"],'ProductComment.expert'=>'1'),'order'=>'ProductComment.create_date DESC'));
		//var_dump($this->data);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);
		if(isset($this->data['FixpriceAnswerCompareitem'])) $this->set('comparelist', $this->data['FixpriceAnswerCompareitem']);
		$this->set('pus', $pus);
		
		$this->set('fixprice_order', $fixprice_order);
		
		$this->set('return_customer', $return_customer);
	}

	function expert_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fixprice answer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FixpriceAnswer->save($this->data)) {
				$this->Session->setFlash(__('The fixprice answer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice answer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FixpriceAnswer->read(null, $id);
		}
		$fixpriceOrders = $this->FixpriceAnswer->FixpriceOrder->find('list');
		$this->set(compact('fixpriceOrders'));
	}

	function expert_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fixprice answer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FixpriceAnswer->delete($id)) {
			$this->Session->setFlash(__('Fixprice answer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fixprice answer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
