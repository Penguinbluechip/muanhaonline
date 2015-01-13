<?php
class StreetsController extends AppController {

	var $name = 'Streets';
	
	public function beforeFilter() {
		$this->Auth->allow('ajaxStreetOption');
	}

	function admin_index() {
		//$this->Street->recursive = 0;
		//$this->Street->contain('District');
		$city_id = 1;
		
		$conditions = array();
		
		//filter district		
		if(!empty($this->params['form']['filter_city_id']) || (isset($this->params['form']['filter_city_id']) && $this->params['form']['filter_city_id'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id'];
		}
		else
			$city_id = $this->Session->read("filter_street_city_id");
		$this->Session->write("filter_street_city_id", $city_id);
		if($city_id)
		{
			$conditions["Street.city_id"] = $city_id;			
		}
		
		//filter district		
		if(!empty($this->params['form']['filter_district_id']) || (isset($this->params['form']['filter_district_id']) && $this->params['form']['filter_district_id'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id'];
		}
		else
			$district_id = $this->Session->read("filter_street_district_id");
		$this->Session->write("filter_street_district_id", $district_id);
		if($district_id)
		{
			//$conditions["DistrictsStreet.district_id"] = $district_id;			
		}
		
		
		$this->paginate = array('conditions'=>$conditions, 'order'=>'Street.order');
		$streets = $this->paginate();
		
		
		
		$districts = $this->Street->District->find('all', array("conditions"=>array("District.city_id"=>$city_id)));		
		$cities = $this->Street->City->find('all');
		
		$this->set('streets', $streets);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);		
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid street', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('street', $this->Street->read(null, $id));
	}

	function admin_add() {
		$city_id = 1;
		if (!empty($this->data)) {
			$this->Street->create();
			if ($this->Street->save($this->data)) {
				$this->Session->setFlash(__('The street has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The street could not be saved. Please, try again.', true));
			}
		}
		$this->data["Street"]["city_id"] = $city_id;
		$dits = $this->Street->District->find('list', array("conditions"=>array("District.city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Street->City->find('list');		
		$this->set(compact('cities', 'districts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid street', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Street->save($this->data)) {
				$this->Session->setFlash(__('The street has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The street could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Street->read(null, $id);
		}
		$cities = $this->Street->City->find('list');
		$districts = $this->Street->District->find('list', array("conditions"=>array("District.city_id"=>$this->data["Street"]["city_id"])));
		$this->set(compact('cities', 'districts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for street', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Street->delete($id)) {
			$this->Session->setFlash(__('Street deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Street was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajaxStreetOption($district_id)
	{
		if (!$district_id) {
			$streets = array();
			$this->Session->setFlash(__('Invalid id for street', true));
			//$this->redirect(array('action'=>'index'));
			$this->set(compact('streets'));
			$this->layout = null;
		}
		else
		{
			//echo $city_id;
			$street = $this->Street->District->read(null, $district_id);
			
			if($street)
			{
				$streets = $this->Street->find("all", array('conditions'=>array('Street.city_id'=>$street['City']['id'])));		
				foreach($streets as $kk => $item)
				{
					$ok = false;		
					if(isset($item['DistrictsStreet']))
					{
						
						foreach($item['DistrictsStreet'] as $dt)
						{					
							if($dt['district_id'] == $district_id)
							{
								$ok = true;
								break;						
							}					
						}
					}
					if(!$ok)
					{
						unset($streets[$kk]);
					}
				}
				//var_dump($streets);
				$this->set(compact('streets'));
				$this->layout = null;
			}
		}
	}
	
	function admin_auto_add()
	{
		
		$city_id = 1;
		if (!empty($this->data)) {
			
			//var_dump($this->data["District"]["District"]);
			if($this->data["District"]["District"])
			{
				//echo $this->data["District"]["District"][0];
				$district_id = $this->data["District"]["District"][0];
				$district = $this->Street->District->read(null, $district_id);
				
				
				
				
				$data = $this->data["Street"]["data"];
				//echo "sdfsfs";
				//preg_match_all( '/\<option(.*?)\>(.*?)\<\//', $data, $match );
				preg_match_all( '/\&lt\;option(.*?)\&gt\;(.*?)\&lt\;\//', $data, $match );
				
				
				$street["Street"]["city_id"] = $district["District"]["city_id"];
				//$street["Street"]["district_id"] = $district["District"]["id"];
				
				foreach($match[2] as $key => $value)
				{
					//find exsit
					//echo "sdfsf";
					$exsit = $this->Street->find("first", array('conditions'=>array('Street.name'=>$value)));
					//var_dump($exsit);
					
					if($exsit)
					{				
						$districtsStreet['DistrictsStreet']['district_id'] = $district["District"]["id"];
						$districtsStreet['DistrictsStreet']['street_id'] = $exsit['Street']['id'];
						
						$exsitz = $this->Street->DistrictsStreet->find("first", array('conditions'=>array('DistrictsStreet.district_id'=>$district_id, 'DistrictsStreet.street_id'=>$exsit['Street']['id'])));
						
						if(!$exsitz)
						{
							$this->Street->DistrictsStreet->create();
							if ($this->Street->DistrictsStreet->save($districtsStreet)) {
								echo "<strong>Đường đã có</strong><br />";
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
					else
					{
						$street["Street"]["name"] = $value;
						$street["Street"]["order"] = $key+1;
						
						
						$this->Street->create();
						if ($this->Street->save($street)) {
							echo "Thêm đường ".$street["Street"]["name"]."<br />";
						} else {
							echo "error<br />";
						}
						
						$districtsStreet['DistrictsStreet']['district_id'] = $district["District"]["id"];
						$districtsStreet['DistrictsStreet']['street_id'] = $exsit = $this->Street->id;
						
						$this->Street->DistrictsStreet->create();
						if ($this->Street->DistrictsStreet->save($districtsStreet)) {
							echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
						} else {
							echo "error<br />";
						}
					}
					
					
				}	
				
			}
				
			
			$city_id = $this->data["Street"]["city_id"];
		}
		$this->data["Street"]["city_id"] = $city_id;
		$dits = $this->Street->District->find('list', array("conditions"=>array("District.city_id"=>$city_id)));
		$districts[0] = "- ".__('Quận/Huyện', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Street->City->find('list');		
		$this->set(compact('cities', 'districts'));
		
		
		
		
		
		//$district_id = 18;
		//$district = $this->Street->District->read(null, $district_id);
		//
		//
		//
		//
		//$data =
		//'<option value="992">Cầm Bá Thước </option><option value="135">Cao Thắng </option><option value="993">Chiến Thắng </option><option value="11">Cô Bắc </option><option value="12">Cô Giang </option><option value="994">Cù Lao </option><option value="995">Đặng Thai Mai </option><option value="996">Đặng Văn Ngữ </option><option value="997">Đào Duy Anh </option><option value="998">Đào Duy Từ (6m) </option><option value="999">Đỗ Tấn Phong </option><option value="1000">Đoàn Thị Điểm (8m) </option><option value="1001">Đường Nội Bộ Khu Dân Cư Rạch Miễu (p.2,7) </option><option value="1002">Hồ Biểu Chánh </option><option value="1003">Hồ Văn Huê </option><option value="227">Hoàng Diệu </option><option value="646">Hoàng Hoa Thám </option><option value="1004">Hoàng Minh Giám </option><option value="648">Hoàng Văn Thụ </option><option value="1005">Huỳnh Văn Bánh </option><option value="1006">Ký Con (6m) </option><option value="142">Lê Quý Đôn </option><option value="1007">Lê Tự Tài </option><option value="143">Lê Văn Sỹ </option><option value="1008">Mai Văn Ngọc </option><option value="146">Ngô Thời Nhiệm </option><option value="966">Nguyễn Công Hoan </option><option value="89">Nguyễn Đình Chiểu </option><option value="1010">Nguyễn Đình Chính </option><option value="1009">Nguyễn Kiệm </option><option value="478">Nguyễn Lâm </option><option value="1011">Nguyễn Thị Huỳnh </option><option value="154">Nguyễn Thượng Hiền </option><option value="689">Nguyễn Trọng Tuyển </option><option value="238">Nguyễn Trường Tộ </option><option value="973">Nguyễn Văn Đậu </option><option value="690">Nguyễn Văn Trỗi </option><option value="1012">Nhiêu Tứ </option><option value="977">Phan Đăng Lưu </option><option value="911">Phan Đình Phùng </option><option value="1013">Phan Tây Hồ </option><option value="529">Phan Xích Long </option><option value="1014">Phùng Văn Cung </option><option value="1015">Thích Quảng Đức </option><option value="113">Trần Cao Vân </option><option value="1016">Trần Hữu Trang </option><option value="1017">Trần Huy Liệu </option><option value="981">Trần Kế Xương </option><option value="117">Trần Khắc Chân </option><option value="1018">Trương Quốc Dung </option><option value="1019">Ven Kênh Nhiêu Lộc Thị Nghè </option>';
		////echo "sdfsfs";
		//preg_match_all( '/\<option(.*?)\>(.*?)\<\//', $data, $match );
		//
		//
		//$street["Street"]["city_id"] = $district["District"]["city_id"];
		////$street["Street"]["district_id"] = $district["District"]["id"];
		//
		//foreach($match[2] as $key => $value)
		//{
		//	//find exsit
		//	//echo "sdfsf";
		//	$exsit = $this->Street->find("first", array('conditions'=>array('Street.name'=>$value)));
		//	//var_dump($exsit);
		//	
		//	if($exsit)
		//	{				
		//		$districtsStreet['DistrictsStreet']['district_id'] = $district["District"]["id"];
		//		$districtsStreet['DistrictsStreet']['street_id'] = $exsit['Street']['id'];
		//		
		//		$this->Street->DistrictsStreet->create();
		//		if ($this->Street->DistrictsStreet->save($districtsStreet)) {
		//			echo "<strong>Đường đã có</strong><br />";
		//			echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
		//		} else {
		//			echo "error<br />";
		//		}
		//	}
		//	else
		//	{
		//		$street["Street"]["name"] = $value;
		//		$street["Street"]["order"] = $key+1;
		//		
		//		
		//		$this->Street->create();
		//		if ($this->Street->save($street)) {
		//			echo "Thêm đường ".$street["Street"]["name"]."<br />";
		//		} else {
		//			echo "error<br />";
		//		}
		//		
		//		$districtsStreet['DistrictsStreet']['district_id'] = $district["District"]["id"];
		//		$districtsStreet['DistrictsStreet']['street_id'] = $exsit = $this->Street->id;
		//		
		//		$this->Street->DistrictsStreet->create();
		//		if ($this->Street->DistrictsStreet->save($districtsStreet)) {
		//			echo ($key+1)."---".$district["City"]["name"]."---".$district["District"]["name"]."---".$value."<br />";
		//		} else {
		//			echo "error<br />";
		//		}
		//	}
		//	
		//	
		//}
		
		
		//$this->layout = null;
	}
}
