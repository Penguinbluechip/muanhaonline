<?php
class CurrenciesController extends AppController {

	var $name = 'Currencies';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('changeCurrency','updateCurrency');
        }
	
	function changeCurrency()
	{
		if (!empty($this->data)) {
			$currency = $this->Currency->find('first', array('conditions'=>array('Currency.id'=>$this->data["Currency"]["id"])));
			$this->Session->write("currency_id",  $currency["Currency"]["id"]);
			$this->redirect("http://".$_SERVER['SERVER_NAME'].$this->data["Currency"]["url"]);
			//var_dump($this->params);
		}
	}
	
	function updateCurrency()
	{
		$this->layout = null;
		
		//Gia ngoai te
		$data = file_get_contents("http://www.vietcombank.com.vn/exchangerates/");
		$order   = array("\r\n", "\n", "\r", "\t");
		$replace = '';
		$data = str_replace($order, $replace, $data);    
		preg_match( '/\<td class\=\"code\"\>USD\<\/td\>(.*?)\>(.*?)\<\/td(.*?)td\>(.*?)\<\/td(.*?)td\>(.*?)\<\/td(.*?)td\>(.*?)\<\/td/', $data, $match );
		$usd_rate = $match[8];
		$usd_rate = str_replace(',', '', $usd_rate);
		//echo $usd_rate;
		
		//Giá vàng
		$data = file_get_contents("http://www.giavangsjc.com/");
		$order   = array("\r\n", "\n", "\r", "\t");
		$replace = '';
		$data = str_replace($order, $replace, $data);    
		preg_match( '/SJC 1L\<\/strong(.*?)\<td(.*?)\>(.*?)\<\/td(.*?)\<td(.*?)\>(.*?)\<\/td/', $data, $match );
		$sjc_rate = $match[6];
		
		//Update USD
		$usd = $this->Currency->find('first',array('conditions'=>array('Currency.id'=>1)));
		if($usd_rate && $usd["Currency"]["rate"] != round(1/$usd_rate, 10))
		{
			$usd["Currency"]["rate"] = round(1/$usd_rate, 10);
			$this->Currency->save($usd);
		}
		
		//Update SJC
		$sjc = $this->Currency->find('first',array('conditions'=>array('Currency.id'=>3)));
		if($sjc_rate && $sjc["Currency"]["rate"] != round(1/($sjc_rate*1000000), 20))
		{
			$sjc["Currency"]["rate"] = round(1/($sjc_rate*1000000), 20);
			$this->Currency->save($sjc);
			echo (1/($sjc_rate*1000000))*1000000000;
		}
		
		//echo $usd_rate;
	}

	function admin_index() {
		$this->Currency->recursive = 0;
		$this->set('currencies', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid currency', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('currency', $this->Currency->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Currency->create();
			if ($this->Currency->save($this->data)) {
				$this->Session->setFlash(__('The currency has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid currency', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Currency->save($this->data)) {
				$this->Session->setFlash(__('The currency has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Currency->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for currency', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Currency->delete($id)) {
			$this->Session->setFlash(__('Currency deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Currency was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
