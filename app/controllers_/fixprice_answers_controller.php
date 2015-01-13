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
		
		if ($fixpriceOrder['FixpriceOrder']['status'] != 3 && $fixpriceOrder['FixpriceOrder']['status'] != -1) {
			$this->Session->setFlash(__('Invalid fixprice order', true));
			$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
		}
		
		Controller::loadModel('FixpriceGtable');
		
		if (!empty($this->data)) {
			
			$this->data['FixpriceAnswer']['fixprice_order_id'] = $fixprice_order_id;
			$this->data['FixpriceAnswer']['price_total'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_total']);
			$this->data['FixpriceAnswer']['price_unit'] = str_replace(",", "", $this->data['FixpriceAnswer']['price_unit']);
			
			
			
			
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
				$this->Session->setFlash(__('The fixprice answer has been saved', true));
				
				//save gtable
				$this->FixpriceGtable->save($this->data);
				
				$this->redirect(array('controller'=>'fixprice_orders','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fixprice answer could not be saved. Please, try again.', true));
			}
		}
		
		$fixpriceAnswer = $this->FixpriceAnswer->find('first', array('conditions'=>array(
														'FixpriceAnswer.fixprice_order_id'=>$fixprice_order_id
													)));
		
		if($fixpriceAnswer)
		{
			$this->data['FixpriceAnswer'] = $fixpriceAnswer['FixpriceAnswer'];
		}
		
		$this->data['FixpriceGtable'] = $fixpriceOrder['FixpriceGtable'];
		
		if(isset($this->data["FixpriceAnswer"]["price_total"]) && $this->data["FixpriceAnswer"]["price_unit"])
		{
			$this->data["FixpriceAnswer"]["price_total"] = $this->data["FixpriceAnswer"]["price_total"] != '' ? number_format($this->data["FixpriceAnswer"]["price_total"],0,".", ",") : "";
			$this->data["FixpriceAnswer"]["price_unit"] = $this->data["FixpriceAnswer"]["price_unit"] != '' ? number_format($this->data["FixpriceAnswer"]["price_unit"],0,".", ",") : "";
		}
		
		if(!isset($this->data["FixpriceAnswer"]["relate_items"]))
		{
			$this->data["FixpriceAnswer"]["relate_items"] = '<table border="0" width="100%">
<tbody>
<tr>
<td width="150px" align="center"><strong>THÔNG TIN</strong></td>
<td align="center"><strong>TSSS 1</strong></td>
<td align="center"><strong>TSSS 2</strong></td>
<td align="center"><strong>TSSS 3</strong></td>
</tr>
<tr>
<td><strong>Địa chỉ tài sản</strong></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><strong>Điện thoại liên hệ</strong></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><strong>Pháp lí</strong></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><strong>Mô tả</strong></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><strong>Giá rao bán</strong></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><strong>Giá thực ước tính</td>
<td> </td>
<td> </td>
<td> </td>
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
		//var_dump($product);
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		$this->set('profile', $profile);
		$this->set('user', $user);
		
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
