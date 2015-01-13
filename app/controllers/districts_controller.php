<?php
class DistrictsController extends AppController {

	var $name = 'Districts';	
	
	public function beforeFilter() {
		$this->Auth->allow('ajaxDistrictOption', 'ajaxDistrictCheckbox', 'ajaxDistrictCheckboxDiv', 'getCurrentDistrict');
	}
	
	function admin_index() {
		$this->District->recursive = 0;
		
		$conditions = array();
		
		//filter city id
		$cities = $this->District->City->find('all');
		//$city_id = $this->Session->read("districts_city_id") ? $this->Session->read("districts_city_id"): "";
		if(!empty($this->params['form']['filter_city_id']))
			$city_id = $this->params['form']['filter_city_id'];
		else
			$city_id = $this->Session->read("districts_city_id");
		
		$this->Session->write("districts_city_id", $city_id);
		
		if($city_id && $city_id != "all")
		{
			$conditions["District.city_id"] = $city_id;			
		}
		//echo $this->Session->read("districts_city_id");
		
		//var_dump($this->params);
		if(count($conditions))
		{
			$this->paginate = array(
				'conditions' => $conditions				
			);
		}
		
		$this->set('districts', $this->paginate());
		$this->set(compact('cities','city_id'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid district', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('district', $this->District->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->District->create();
			if ($this->District->save($this->data)) {
				$this->Session->setFlash(__('The district has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.', true));
			}
		}
		$cities = $this->District->City->find('list');
		$this->set(compact('cities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid district', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->District->save($this->data)) {
				$this->Session->setFlash(__('The district has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->District->read(null, $id);
		}
		$cities = $this->District->City->find('list');
		$this->set(compact('cities'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for district', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->District->delete($id)) {
			$this->Session->setFlash(__('District deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('District was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajaxDistrictOption($city_id = 1)
	{
		//echo $city_id;
		$districts = $this->District->find("all", array("conditions"=>array("District.city_id"=>$city_id)));
		//echo count($districts);
		$this->set(compact('districts'));
		$this->layout = null;
	}
	
	function ajaxDistrictCheckbox($city_id = 1)
	{
		//echo $city_id;
		$districts = $this->District->find("all", array("conditions"=>array("District.city_id"=>$city_id)));
		//echo count($districts);
		$this->set(compact('districts'));
		$this->layout = null;
	}
	
	function ajaxDistrictCheckboxDiv($city_id = 1)
	{
		//echo $city_id;
		$districts = $this->District->find("all", array("conditions"=>array("District.city_id"=>$city_id)));
		//echo count($districts);
		$this->set(compact('districts'));
		$this->layout = null;
	}
	
	function getCurrentDistrict($id = null) {
		if($this->Session->read("filter_district_id"))
			return $this->District->read(null, $this->Session->read("filter_district_id"));
		else
			return 0;
	}
}
