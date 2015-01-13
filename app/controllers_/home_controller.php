<?php
class HomeController extends AppController {

	var $name = 'Home';
        var $uses = array();
        var $layout = "home";
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('index', 'aboutus', 'snippet');
        }
        
        function index()
        {
            Controller::loadModel('Product');
	    Controller::loadModel('Content');
            
            $specialProducts = $this->Product->find("all", array(
								'limit'=>5,
								'conditions'=>array(
										'Product.featured'=>'1',
										'Product.published'=>'2'
								),
								'order'=>'Product.create_date DESC')
						    );
	    foreach($specialProducts as $key => $p)
	    {
		//$salesProducts[$key]["Product"]["sname"] = parent::snippet($p["Product"]["name"], 25);
		$specialProducts[$key]["Product"]["description"] = "<p>".parent::snippet($p["Product"]["description"], 600)."</p>";
		//Price
			Controller::loadModel('Currency');
			
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
				
				$specialProducts[$key]["prices"][$item['Currency']['id']] = array(
								    'id'=>$item['Currency']['id'],
								    'code'=>$item['Currency']['code'],
								    'value'=>$value
							);
			}
		}
		else
		{
			$specialProducts[$key]["Product"]["price"] = 0;
		}
		
	    }
	    
	    $topProducts = $this->Product->find("all", array(
								'limit'=>15,
								'conditions'=>array(
										'Product.top_new'=>'1',
										'Product.published'=>'2'
								),
								'order'=>'Product.create_date DESC')
						    );
	    foreach($topProducts as $key => $p)
	    {
		//$salesProducts[$key]["Product"]["sname"] = parent::snippet($p["Product"]["name"], 25);
		//$salesProducts[$key]["Product"]["sdescription"] = parent::snippet($p["Product"]["description"], 65);
		//Price
			Controller::loadModel('Currency');
		if($p["Product"]["price"]) {
			if($p['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";
			$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
			if($currency["Currency"]["id"] == 2)
				$topProducts[$key]["Product"]["price"] = parent::priceFormat(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"]).$cur;
			else
			{
				$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
				$topProducts[$key]["Product"]["price"] = number_format(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
			}
		}
		else
		{
			$topProducts[$key]["Product"]["price"] = 0;
		}
		
	    }
	    foreach($topProducts as $key => $p)
	    {
		if($key < 7)
			$topProducts[] = $p;
		else
			break;
	    }
	    
	    
            $salesProducts = $this->Product->find("all", array(
							'limit'=>5,
							'conditions'=>array(
									'Product.published'=>'2',
									'Product.for'=>'s',
									'Product.top_sale'=>'1'
							),
							'order'=>'Product.create_date DESC')
						);
	    foreach($salesProducts as $key => $p)
	    {
		$salesProducts[$key]["Product"]["sname"] = parent::snippet($p["Product"]["name"], 30);
		$salesProducts[$key]["Product"]["sdescription"] = parent::snippet($p["Product"]["description"], 65);
		
		//Price
			Controller::loadModel('Currency');
			
		if($p["Product"]["price"]) {
			if($p['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";
			$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
			if($currency["Currency"]["id"] == 2)
				$salesProducts[$key]["Product"]["price"] = parent::priceFormat(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"]).$cur;
			else
			{
				$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
				$salesProducts[$key]["Product"]["price"] = number_format(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
			}
		}
		else
		{
			$salesProducts[$key]["Product"]["price"] = 0;
		}
		
	    }
	    
            $leasingProducts = $this->Product->find("all", array(
							'limit'=>5,
							'conditions'=>array(
									'Product.published'=>'2',
									'Product.for'=>'l',
									'Product.top_lease'=>'1'
							),
							'order'=>'Product.create_date DESC'));
	    foreach($leasingProducts as $key => $p)
	    {
		$leasingProducts[$key]["Product"]["sname"] = parent::snippet($p["Product"]["name"], 30);
		$leasingProducts[$key]["Product"]["sdescription"] = parent::snippet($p["Product"]["description"], 65);
		
		
		//Price
			Controller::loadModel('Currency');
		if($p["Product"]["price"]) {
			if($p['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";
			$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
			if($currency["Currency"]["id"] == 2)
				$leasingProducts[$key]["Product"]["price"] = parent::priceFormat(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"]).$cur;
			else
			{
				$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
				$leasingProducts[$key]["Product"]["price"] = number_format(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
			}
		}
		else
		{
			$leasingProducts[$key]["Product"]["price"] = 0;
		}
		
	    }
	    
	    $newProducts = $this->Product->find("all", array(
							'limit'=>12,
							'conditions'=>array(									
									'Product.published'=>'2',
									'Product.top_hit'=>'1'
							),
							'order'=>'Product.create_date DESC'));
	    foreach($newProducts as $key => $p)
	    {
		$newProducts[$key]["Product"]["sname"] = parent::snippet($p["Product"]["name"], 35);
		$newProducts[$key]["Product"]["sdescription"] = parent::snippet($p["Product"]["description"], 80);
		
		//Price
			Controller::loadModel('Currency');
		if($p["Product"]["price"]) {
			if($p['Product']['price_perm2'] == 1)
				$cur = "/m2";
			else if($p['Product']['price_perm2'] == 2)
				$cur = "/tháng";
			else $cur = "";
			$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->Session->read("currency_id"))));
			if($currency["Currency"]["id"] == 2)
				$newProducts[$key]["Product"]["price"] = parent::priceFormat(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"]).$cur;
			else
			{
				$tp = $currency["Currency"]["id"] == 3 ? 3 : 0;
				$newProducts[$key]["Product"]["price"] = number_format(($p["Product"]["price"]*$currency["Currency"]["rate"])/$p["CurrencyPrice"]["rate"],$tp,".", " ")." ".$currency["Currency"]["code"].$cur;
			}
		}
		else
		{
			$newProducts[$key]["Product"]["price"] = 0;
		}
	    }
	    
	    $welcome = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'1'
							)
						)
					);
            
            //var_dump($specialProducts);
	    $cities = $this->Product->City->find('all');
	    $keyword = "";
            
            $this->set(compact('specialProducts', 'salesProducts', 'leasingProducts', 'newProducts', 'welcome', 'cities', 'keyword', 'topProducts'));
        }
	
	function aboutus()
	{
		Controller::loadModel('Content');
		Controller::loadModel('Type');
		$intro = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'4'
							)
						)
					);
		$team_expert = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'5'
							)
						)
					);
		$proview = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'6'
							)
						)
					);
		$letter = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'7'
							)
						)
					);
		//echo parent::snippet("33","33");
		$types = $this->Type->find('all');
		$this->set(compact('intro', 'team_expert', 'proview', 'types', 'letter'));
	}
	
	
}
