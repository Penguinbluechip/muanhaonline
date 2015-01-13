<?php
class WardsController extends AppController {

	var $name = 'Wards';
	
	public function beforeFilter() {
		$this->Auth->allow('ajaxWardOption');
	}

	function admin_index() {
		$this->Ward->recursive = 0;
		$city_id = 1;
		
		$conditions = array();
		
		//filter district		
		if(!empty($this->params['form']['filter_city_id']) || (isset($this->params['form']['filter_city_id']) && $this->params['form']['filter_city_id'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id'];
		}
		else
			$city_id = $this->Session->read("filter_ward_city_id");
		$this->Session->write("filter_ward_city_id", $city_id);
		if($city_id)
		{
			$conditions["Ward.city_id"] = $city_id;			
		}
		
		
		//filter district		
		if(!empty($this->params['form']['filter_district_id']) || (isset($this->params['form']['filter_district_id']) && $this->params['form']['filter_district_id'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id'];
		}
		else
			$district_id = $this->Session->read("filter_ward_district_id");
		$this->Session->write("filter_ward_district_id", $district_id);
		if($district_id)
		{
			$conditions["Ward.district_id"] = $district_id;			
		}
		
		$this->paginate = array('conditions'=>$conditions, 'order'=>'Ward.order');
		$wards = $this->paginate();
		
		$districts = $this->Ward->District->find('all', array("conditions"=>array("District.city_id"=>$city_id)));		
		$cities = $this->Ward->City->find('all');
		
		$this->set('wards', $wards);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);
		$this->set('districts', $districts);
		$this->set('district_id', $district_id);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ward', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ward', $this->Ward->read(null, $id));
	}

	function admin_add() {
		$city_id = 1;
		if (!empty($this->data)) {
			$this->Ward->create();
			if ($this->Ward->save($this->data)) {
				$this->Session->setFlash(__('The ward has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ward could not be saved. Please, try again.', true));
			}
			$city_id = $this->data["Product"]["city_id"];
		}
		$this->data["Ward"]["city_id"] = $city_id;
		$dits = $this->Ward->District->find('list', array("conditions"=>array("District.city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Ward->City->find('list');		
		$this->set(compact('cities', 'districts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ward', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ward->save($this->data)) {
				$this->Session->setFlash(__('The ward has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ward could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ward->read(null, $id);
		}
		$cities = $this->Ward->City->find('list');
		$districts = $this->Ward->District->find('list', array("conditions"=>array("District.city_id"=>$this->data["Ward"]["city_id"])));
		$this->set(compact('cities', 'districts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ward', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ward->delete($id)) {
			$this->Session->setFlash(__('Ward deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ward was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajaxWardOption($district_id)
	{
		//echo $city_id;
		$wards = $this->Ward->find("all", array("conditions"=>array("Ward.district_id"=>$district_id)));
		
		$this->set(compact('wards'));
		$this->layout = null;
	}
	
	function admin_auto_add()
	{
		
		$city_id = 1;
		if (!empty($this->data)) {
			
			if($this->data["Ward"]["district_id"])
			{
				$district_id = $this->data["Ward"]["district_id"];
				$district = $this->Ward->District->read(null, $district_id);
				$data = $this->data["Ward"]["data"];
				//echo "sdfsfs";
				//preg_match_all( '/\<option(.*?)\>(.*?)\<\//', $data, $match );
				preg_match_all( '/\&lt\;option(.*?)\&gt\;(.*?)\&lt\;\//', $data, $match );
				//echo $data;
				
				$ward["Ward"]["city_id"] = $district["District"]["city_id"];
				$ward["Ward"]["district_id"] = $district["District"]["id"];
				
				//var_dump($match);
				
				foreach($match[2] as $key => $value)
				{
					
					$ward["Ward"]["name"] = $value;
					$ward["Ward"]["order"] = $key+1;
					
					//echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
					
					$exsit = $this->Ward->find('first', array('conditions'=>array('Ward.name'=>$ward["Ward"]["name"], 'Ward.district_id'=>$district_id)));
					
					if(!$exsit)
					{
						$this->Ward->create();
						if ($this->Ward->save($ward)) {
							echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
						} else {
							echo "error<br />";
						}
					}
					else
					{
						echo "Đã có <strong>".$value."</strong><br />";
					}
					
					
				}
			}
				
			
			$city_id = $this->data["Ward"]["city_id"];
		}
		$this->data["Ward"]["city_id"] = $city_id;
		$dits = $this->Ward->District->find('list', array("conditions"=>array("District.city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Ward->City->find('list');		
		$this->set(compact('cities', 'districts'));
		
		
		//$district_id = 25;
		//$district = $this->Ward->District->read(null, $district_id);
		//$data =
		//'<option value="2259">Hiệp Phước</option><option value="2256">Long Thới</option><option value="2257">Nhơn Đức</option><option value="2255">Phú Xuân</option><option value="2258">Phước Kiểng</option><option value="2260">Phước Lộc</option>';
		////echo "sdfsfs";
		//preg_match_all( '/\<option(.*?)\>(.*?)\<\//', $data, $match );
		//
		//
		//$ward["Ward"]["city_id"] = $district["District"]["city_id"];
		//$ward["Ward"]["district_id"] = $district["District"]["id"];
		//
		//foreach($match[2] as $key => $value)
		//{
		//	$ward["Ward"]["name"] = $value;
		//	$ward["Ward"]["order"] = $key+1;
		//	
		//	$this->Ward->create();
		//	if ($this->Ward->save($ward)) {
		//		echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
		//	} else {
		//		echo "error<br />";
		//	}
		//	
		//	
		//}
		//
		
		//$this->layout = null;
	}
}
