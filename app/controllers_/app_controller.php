<?php
class AppController extends Controller {
  public $components = array(
    'Acl',
    'Auth' => array(
      'authorize' => 'actions',
      'loginRedirect' => array(
        'admin' => false,
        'controller' => 'users',
        'action' => 'dashboard'
      ),
      'loginError' => 'Thông tin tài khoản không đúng.',
      'authError' => 'Bạn không thể truy xuất được phần này. Vui lòng đăng nhập hoặc đăng ký với chúng tôi'
    ),
  'Session',
  'SwiftMailer',
  'RequestHandler'
  );
  //var $components = array('SwiftMailer'); 
  
  function beforeFilter() {
    $user = $this->Auth->user();
    if (!empty($user)) {
      Configure::write('User', $user[$this->Auth->getModel()->alias]);
    }
    Controller::loadModel('Currency');
    if($this->Session->read("currency_id") == '')
    {      
      $this->Session->write("currency_id", 2);
    }
    
    
  }
  
  public function beforeRender() {
    $user = $this->Auth->user();
    Controller::loadModel('Group');
    
    if (!empty($user)) {
      $user = $user[$this->Auth->getModel()->alias];
      $group = $this->Group->find('first', array('conditions' => array('Group.id'=>$this->Auth->user('group_id'))));
    }
    
    //default currency rate
    //echo $this->Session->read("currency_id")."sdfdsfsdfsf";
    if($this->Session->read("currency_id") == '')
    {      
      $this->Session->write("currency_id", 2);
    }
    
    //Update TyGia    
    $this->set(compact('user'));
    $this->set(compact('group'));
    
    Controller::loadModel('Product');
    $products = $this->Product->find('all');
    foreach($products as $kk => $p)
    {
      
      if(strtotime($p["Product"]["expire_date"]) <= strtotime(date('Y-m-d H:i:s')) && ($p["Product"]["published"] == 2 || $p["Product"]["published"] == 3) && $p["Product"]["published"] != "-1")
      {
	//echo $p["Product"]["name"];
	$p["Product"]["published"] = "-1";
	$this->Product->save($p);
      }
    }
    
    $this->online_render();
    
  }
  
    //count online users
    public function online_render() {
        //echo "sdfsdfsfs";
        Controller::loadModel('User');
            $time = 900;
		$user = $this->Auth->user();    
		
		$onlines = $this->User->Online->find('all', array('conditions'=>array('Online.offline'=>0)));
		foreach($onlines as $kk => $o)
		{
			if(strtotime(date('Y-m-d H:i:s')) - strtotime($o["Online"]["date"]) > $time)
			{
				//$this->User->Online->delete($o["Online"]["id"]);
				$onlines[$kk]["Online"]["offline"] = 1;
				$this->User->Online->save($onlines[$kk]);
			}
		}
		
		if($this->Session->read('ipname') != '')
		{
			$ipname = $this->Session->read('ipname');
			$exsit = $this->User->Online->find('first', array('conditions'=>array('Online.ip'=>$ipname, 'Online.offline'=>0)));
			
			if($exsit)
			{
				$exsit["Online"]["date"] = date('Y-m-d H:i:s');
				if (!empty($user)) {
					$exsit["Online"]["user_id"] = $user["User"]["id"];
				}
				else
				{
					$exsit["Online"]["user_id"] = 0;
				}
				$this->User->Online->save($exsit);
			}
			else
			{
				$this->Session->write('ipname', '');
			}
		}
		
		if($this->Session->read('ipname') == '')
		{
			$this->Session->write('ipname', $this->RequestHandler->getClientIp()."_".strtotime(date('Y-m-d H:i:s')));
			$online["Online"]["ip"] = $this->Session->read('ipname');
			$online["Online"]["date"] = date('Y-m-d H:i:s');
			if (!empty($user)) {
				$online["Online"]["user_id"] = $user["User"]["id"];
			}
			$this->User->Online->create();
			$this->User->Online->save($online);
		}
    }
  
  public function snippet($text,$length=64,$tail="...") {
		$text = trim(strip_tags($text));
		$txtl = strlen($text);
		if($txtl > $length) {
		    for($i=1;$text[$length-$i]!=" ";$i++) {
			if($i == $length) {
			    return substr($text,0,$length) . $tail;
			}
		    }
		    $text = substr($text,0,$length-$i+1) . $tail;
		}
		return $text;
  }
  
  public function getImage($text) {
        preg_match( '/img(.*?)src\=\"(.*?)\"/', $text, $match );
	//echo $match[0];
	//var_dump($match);
        return isset($match[2]) ? $match[2] : 0;
  }
  
  public function priceFormat($number)
  {
    //echo strlen($number)>6;
    if(strlen($number) > 9)
    {
      $number = round($number, -6);
      $number = substr($number, 0, strlen($number)-6);
      $le = substr($number, strlen($number)-3, 3);
      $chan = substr($number, 0, strlen($number)-3);
      $le = preg_replace('/(0+)$/', '', $le);
      $le = $le != "" ? ".".$le : "";
      //echo $le.$chan;
      $chan = number_format($chan,0,",", " ");
      
      $number = $chan.$le." Tỷ";
    }
    else if(strlen($number) > 6)
    {
      $number = round($number, -3);
      $number = substr($number, 0, strlen($number)-3);
      $le = substr($number, strlen($number)-3, 3);
      $chan = substr($number, 0, strlen($number)-3);
      $le = preg_replace('/(0+)$/', '', $le);
      $le = $le != "" ? ".".$le : "";
      //echo $le.$chan;
      $chan = number_format($chan,0,",", " ");
      
      $number = $chan.$le." Tr";
    }
    else
    {
      $number = number_format($number,0,",", " ")." VNĐ";
    }
    return $number;
  }
  
  public function dateFormat($date)
  {
    //echo strlen($number)>6;
    //echo date('Y-m-d H:i:s');
    $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
    
    $count_minutes = $seconds/60;
    $count_seconds = $seconds%60;    
    
    $count_hours = $count_minutes/60;
    $count_minutes = $count_minutes%60;    
    
    $count_days = $count_hours/24;
    $count_hours = $count_hours%24;    
    
    $count_weeks = $count_days/7;
    $count_days = $count_days%7;
    
    //$week_string = $count_weeks > 1 ? $count_weeks." tuần " : '';
    $day_string = $count_days >= 1 ? $count_days." ngày " : '';
    $hour_string = $count_hours >= 1 ? $count_hours." giờ " : '';
    $minute_string = $count_minutes >= 1 && $count_days < 1 ? $count_minutes." phút " : '';
    $second_string = $count_seconds >= 1 && $count_minutes < 1 ? $count_seconds." giây " : '';
    
    $result = "cách đây ".$day_string.$hour_string.$minute_string.$second_string."trước";
    
    if($count_weeks >= 1)
    {
      $result = "ngày ".date('d', strtotime($date))." tháng ".date('m', strtotime($date))." ".date('Y', strtotime($date)).", vào lúc ".date('H:i', strtotime($date));
    }
    
    //echo $count_minutes;
    
    return $result;
  }
  
  public function dateFormat_news($date)
  {
    //echo strlen($number)>6;
    //echo date('Y-m-d H:i:s');
    //echo $date;
      
    if(strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($date))))
    {
      $result = "Hôm nay, lúc ".date('H:i', strtotime($date));
    }
    else
    {
      $result = date('d-m-Y', strtotime($date));
    }
    
    //echo $count_minutes;
    
    return $result;
  }
  
  
    public function sendAlerts($product = null)
    {
        Controller::loadModel('Product');
        Controller::loadModel('Need');
        
        //$needs = $this->Needs->find('all');
        
        $conditions = array();
        
        //for
        if($product['Product']['for'])
        {
            $conditions['Need.for LIKE'] = '%'.$product['Product']['for'].'%';
        }
        
        //categories
        if($product['Product']['category_id'])
        {
            $conditions['Need.categories LIKE'] = '%,'.$product['Product']['category_id'].',%';
        }
        
        //categories
        if($product['Product']['district_id'])
        {
            $conditions['Need.districts LIKE'] = '%,'.$product['Product']['district_id'].',%';
        }
        
        //price from
        if($product['Product']['price'])
        {
            $conditions['Need.price_from <='] = $product['Product']['price'];      
            $conditions['Need.price_to >='] = $product['Product']['price'];
        }
        
        //currency
        if($product['Product']['price_currency'])
        {
            $conditions['Need.currency_id'] = $product['Product']['price_currency'];     
           
        }
        
        //per
        if($product['Product']['price_perm2'])
        {
            $conditions['Need.price_perm2'] = $product['Product']['price_perm2'];     
           
        }
        
        //directions
        if($product['Product']['direction'])
        {
            $conditions['Need.directions LIKE'] = '%,'.$product['Product']['direction'].',%';
        }
        
        //lot area
        if($product['Product']['lot_area'])
        {
            if($product['Product']['lot_area'] <= 50)
            {
                $conditions['Need.lot_area'] = '0_50';
            }
            else if($product['Product']['lot_area'] <= 70)
            {
                $conditions['Need.lot_area'] = '50_70';
            }
            else if($product['Product']['lot_area'] <= 100)
            {
                $conditions['Need.lot_area'] = '70_100';
            }
            else
            {
                $conditions['Need.lot_area'] = '100_0';
            }
        }
        
        //property area
        if($product['Product']['property_area'])
        {
            if($product['Product']['property_area'] <= 50)
            {
                $conditions['Need.property_area'] = '0_50';
            }
            else if($product['Product']['property_area'] <= 70)
            {
                $conditions['Need.property_area'] = '50_70';
            }
            else if($product['Product']['property_area'] <= 100)
            {
                $conditions['Need.property_area'] = '70_100';
            }
            else
            {
                $conditions['Need.property_area'] = '100_0';
            }
        }
        
        //directions
        if($product['Product']['bedrooms'])
        {
            $conditions['Need.bedrooms'] = array($product['Product']['bedrooms']-1, $product['Product']['bedrooms'], $product['Product']['bedrooms']+1);
        }
        
        $needs = $this->Need->find('all', array('conditions' => $conditions, 'limit'=>10));
	
	//echo var_dump($needs);
        
        foreach($needs as $n)
        {
            //Sending email						
						$this->SwiftMailer->smtpType = 'tls';
						$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
						$this->SwiftMailer->smtpPort = 587;
						$this->SwiftMailer->smtpUsername = 'webservice@muanhaonline.com.vn';
						$this->SwiftMailer->smtpPassword = 'bdsonline$';
					
						$this->SwiftMailer->sendAs = 'html';
						$this->SwiftMailer->from = 'info@muanhaonline.com.vn';
						$this->SwiftMailer->fromName = 'MuaNhaOnline.com.vn';
                                                if($n['Need']['user_id'])
                                                {
                                                    $this->SwiftMailer->to = $n["User"]["email"];
                                                    $cname = $n["User"]["username"];
                                                }
                                                else
                                                {
                                                    $this->SwiftMailer->to = $n['Need']["guest_email"];
                                                    $cname = $n['Need']["guest_name"];
                                                    
                                                }
						//set variables to template as usual
						$this->set('cname', $cname);
						$this->set('need', $n);
						$this->set('prod', $product);
						
						try {
						    if(!$this->SwiftMailer->send('product_alert', "Bất động sản theo nhu cầu")) {
							$this->log("Error sending email");							
						    }
						}
						catch(Exception $e) {
						      $this->log("Failed to send email: ".$e->getMessage());
						      $error = "failed".$e->getMessage();
						      $this->Session->setFlash($e->getMessage());
						}
        }
        
        //var_dump($needs);
        //var_dump($conditions);
        
    }
}
?>