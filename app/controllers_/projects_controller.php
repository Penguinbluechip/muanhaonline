<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	
	public function beforeFilter() {
		$this->Auth->allow('ajaxProjectOption', 'ajaxProjectAddress', 'details', 'index', 'reset', 'getProjectByCategory', 'getNewProjects');
	}	
	
	function index()
	{
		$this->layout = 'home';
		$this->Project->recursive = 0;
		
		//var_dump($this->params);
		
		//Get all filters
		$conditions = array();		
		
		//filter city		
		if(!empty($this->params['form']['filter_city_id1']) || (isset($this->params['form']['filter_city_id1']) && $this->params['form']['filter_city_id1'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id1'];
		}
		else
			$city_id = $this->Session->read("filter_city_id1");
		$this->Session->write("filter_city_id1", $city_id);
		if($city_id)
		{
			$conditions["Project.city_id"] = $city_id;
			$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			//$projects = array();
		}
		else
		{
			$districts = array();
			//$projects = array();
		}
		
		//filter category
		//echo $this->Session->read("filter_category_id1");
		$projectCategories = $this->Project->ProjectCategory->find('all');
		if(!empty($this->params['form']['filter_category_id1']) || (isset($this->params['form']['filter_category_id1']) && $this->params['form']['filter_category_id1'] == 0))
		{
			$category_id = $this->params['form']['filter_category_id1'];
		}
		else
		{
			$category_id = $this->Session->read("filter_category_id1");
			
		}
		$this->Session->write("filter_category_id1", $category_id);
		if($category_id)
		{
			$conditions["Project.project_category_id"] = $category_id;
			//$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			//$projects = array();
		}
		else
		{
			//$districts = array();
			//$projects = array();
		}
		
		//filter district		
		if(!empty($this->params['form']['filter_district_id1']) || (isset($this->params['form']['filter_district_id1']) && $this->params['form']['filter_district_id1'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id1'];
		}
		else
			$district_id = $this->Session->read("filter_district_id1");
		$this->Session->write("filter_district_id1", $district_id);
		
		$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		if($district_id)
		{
			$conditions["Project.district_id"] = $district_id;
		}		
		
		//filter keyword		
		if(!empty($this->params['form']['filter_keyword1']) || (isset($this->params['form']['filter_keyword1']) && $this->params['form']['filter_keyword1'] == ''))
		{
			$keyword = $this->params['form']['filter_keyword1'];
		}
		else
			$keyword = $this->Session->read("filter_keyword1");
		$this->Session->write("filter_keyword1", $keyword);
		if($keyword != '')
		{
			$conditions["Project.name LIKE ?"] = '%'.$keyword.'%';			
		}		
		
		
		$this->paginate = array('conditions'=>$conditions, 'limit'=>7);
		$projects = $this->paginate();
		
		
		foreach($projects as $key => $p)
		{
			$image = $this->Project->ProjectImage->find('first', array(
									'conditions'=>array(
										'ProjectImage.project_id'=>$p["Project"]["id"]
									)
								));
			$projects[$key]['ProjectImage'] = $image["ProjectImage"];
			$projects[$key]["Project"]["sdescription"] = parent::snippet(strip_tags($p["Project"]["description"]), 200);
		}
		//var_dump($products);
		
		//filter 
		$cities = $this->Project->City->find('all');
		
		
		//var_dump($types);
		
		$this->set('projects', $projects);
		$this->set('projectCategories', $projectCategories);
		$this->set('category_id', $category_id);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);
		$this->set('districts', $districts);
		$this->set('district_id', $district_id);		
		$this->set('keyword', $keyword);		
	}
	
	function reset()
	{

		$this->Session->write("filter_city_id1", 0);
		$this->Session->write("filter_category_id1", 0);
		$this->Session->write("filter_district_id1", 0);
		$this->Session->write("filter_keyword1", '');
		
		$this->redirect(array('action' => 'index'));
	}
	
	function getProjectByCategory($id = null)
	{
		$this->Session->write("filter_city_id1", 0);
		$this->Session->write("filter_category_id1", $id);
		$this->Session->write("filter_district_id1", 0);
		$this->Session->write("filter_keyword1", '');
		
		$this->redirect(array('action' => 'index'));
	}
	
	function details($id = null)
	{
		Controller::loadModel('Content');
		Controller::loadModel('UserProfile');
		$this->layout = 'home';
		if (!$id) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		$project = $this->Project->read(null, $id);
		
		
		
		//Image list
		$images = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$project["Project"]["id"])));
		
		$slogan = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'3'
							)
						)
					);
		
		$relatedProjects = $this->Project->find("all", array(
								
								'limit'=>4
							));
		foreach($relatedProjects as $key => $p)
		{
		    $relatedProjects[$key]["Project"]["name"] = parent::snippet(strip_tags($p["Project"]["name"]), 40);
		    //$relatedProjects[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
		    $relatedProjects[$key]["Project"]["link"] = array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Project"]["name"])));
		    //$relatedProjects[$key]["Project"]["price"] = $p["Project"]["price"] != '' ? number_format($p["Project"]["price"],0,".", ",") : "";
		}
		
		//var_dump($relatedProjects);
		//$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$project["User"]["id"])));
		
		$cities = $this->Project->City->find('all');
		
		
		//var_dump($types);
		$keyword = "";
		
		$profile = $this->UserProfile->find("first", array('conditions'=>array('UserProfile.user_id'=>$project["User"]["id"])));
		
		//Image list
		$images['real'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$id,'ProjectImage.type !='=>2)));
		$images['design'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$id,'ProjectImage.type '=>2)));
		
		//$this->set('projects', $projects);
		$this->set('cities', $cities);
		$this->set('keyword', $keyword);
		
		$this->set('project', $project);
		$this->set('images', $images);
		$this->set('slogan', $slogan);
		//$this->set('profile', $profile);
		$this->set('relatedProjects', $relatedProjects);
		$this->set('images', $images);
		$this->set('profile', $profile);
	}

	function admin_index() {
		$this->Project->recursive = 0;
		//Get all filters
		$conditions = array();		
		
		//filter district		
		if(!empty($this->params['form']['filter_city_id1']) || (isset($this->params['form']['filter_city_id1']) && $this->params['form']['filter_city_id1'] == 0))
		{
			$city_id = $this->params['form']['filter_city_id1'];
		}
		else
			$city_id = $this->Session->read("filter_city_id1");
		$this->Session->write("filter_city_id1", $city_id);
		if($city_id)
		{
			$conditions["Project.city_id"] = $city_id;
			$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
			//$projects = array();
		}
		else
		{
			$districts = array();
			//$projects = array();
		}
		
		//filter district		
		if(!empty($this->params['form']['filter_district_id1']) || (isset($this->params['form']['filter_district_id1']) && $this->params['form']['filter_district_id1'] == 0))
		{
			$district_id = $this->params['form']['filter_district_id1'];
		}
		else
			$district_id = $this->Session->read("filter_district_id1");
		$this->Session->write("filter_district_id1", $district_id);
		
		$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		if($district_id)
		{
			$conditions["Project.district_id"] = $district_id;
		}		
		
		//filter keyword		
		if(!empty($this->params['form']['filter_keyword1']) || (isset($this->params['form']['filter_keyword1']) && $this->params['form']['filter_keyword1'] == ''))
		{
			$keyword = $this->params['form']['filter_keyword1'];
		}
		else
			$keyword = $this->Session->read("filter_keyword1");
		$this->Session->write("filter_keyword1", $keyword);
		if($keyword != '')
		{
			$conditions["Project.name LIKE ?"] = '%'.$keyword.'%';			
		}		
		
		
		$this->paginate = array('conditions'=>$conditions);
		$projects = $this->paginate();
		
		
		foreach($projects as $key => $p)
		{
			$image = $this->Project->ProjectImage->find('first', array(
									'conditions'=>array(
										'ProjectImage.project_id'=>$p["Project"]["id"]
									)
								));
			$projects[$key]['ProjectImage'] = $image["ProjectImage"];
		}
		$cities = $this->Project->City->find('all');
		$this->set('projects', $projects);
		$this->set('cities', $cities);
		$this->set('city_id', $city_id);
		$this->set('districts', $districts);
		$this->set('district_id', $district_id);		
		$this->set('keyword', $keyword);	
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		//Image list
		$images = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$id)));
		
		
		$this->set('images', $images);
		$this->set('project', $this->Project->read(null, $id));
	}

	function admin_add() {
		$user = $this->Auth->user();
		
		$user = $this->Auth->user();
		$conditions = array('Project.user_id'=>$user["User"]["id"]);
		$count_p = $this->Project->find('all', array('conditions'=>$conditions));
		if(count($count_p) >= 2)
		{
			$this->Session->setFlash(__('Bạn chỉ được tạo tối đa 2 dự án', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			//convert number
			//$this->data["Project"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			//$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			//$this->data["Product"]["area_x"] = str_replace(",", "", $this->data["Product"]["area_x"]);
			//$this->data["Product"]["area_y"] = str_replace(",", "", $this->data["Product"]["area_y"]);
			
			
			$this->data["Project"]["user_id"] = $user["User"]["id"];
			
			
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('Dự án đã được thêm.', true));
				
				
				//save images
				foreach($this->data["ProjectImage"] as $item)
				{
					if($item["filename"] != "")
					{
						$image["ProjectImage"] = $item;
						$image["ProjectImage"]["title"] = $this->data["Project"]["name"];
						$image["ProjectImage"]["project_id"] = $this->Project->id;
						
						$this->Project->ProjectImage->create();
						if ($this->Project->ProjectImage->save($image["ProjectImage"])) {
							//$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
				}
				
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		$this->data["Project"]["city_id"] = 1;
		$dits = $this->Project->District->find('list', array("conditions"=>array("city_id"=>1)));
		//$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Project->City->find('list');
		$pcs = $this->Project->ProjectCategory->find('list');
		$projectCategories[0] = "- ".__('khác', true)." -";
		foreach($pcs as $key => $value)
		{
			$projectCategories[$key] = $value;
		}
		$this->set(compact('districts', 'cities', 'projectCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			//if(!$this->Project->User->isUserProject($user["User"]["id"], $id))
			//{
			//	$this->Session->setFlash(__('Manager doesn\'t has role on this project', true));
			//	$this->redirect(array('action' => 'index'));
			//	//echo "sfsdfsdfsdfs";
			//}
		
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('Dự án đã được chỉnh sửa', true));
				
				
				//save images
				foreach($this->data["ProjectImage"] as $item)
				{
					if($item["filename"] != "")
					{
						$image["ProjectImage"] = $item;
						$image["ProjectImage"]["title"] = $this->data["Project"]["name"];
						$image["ProjectImage"]["project_id"] = $this->Project->id;
						
						$this->Project->ProjectImage->create();
						if ($this->Project->ProjectImage->save($image["ProjectImage"])) {
							//$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
				}
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$dits = $this->Project->District->find('list', array("conditions"=>array("city_id"=>$this->data["Project"]["city_id"])));			
		$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		
		//Image list
		$images['real'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$this->data["Project"]["id"],'ProjectImage.type'=>1)));
		$images['design'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$this->data["Project"]["id"],'ProjectImage.type'=>2)));
		$cities = $this->Project->City->find('list');
		$pcs = $this->Project->ProjectCategory->find('list');
		//$projectCategories[0] = "- ".__('khác', true)." -";
		foreach($pcs as $key => $value)
		{
			$projectCategories[$key] = $value;
		}
		$this->set(compact('districts', 'cities', 'images', 'projectCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Project->delete($id)) {
			$this->Session->setFlash(__('Project deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function manager_index() {
		$this->Project->recursive = 0;
		//Get all filters
		$user = $this->Auth->user();
		$conditions = array('Project.user_id'=>$user["User"]["id"]);		
		
		////filter district		
		//if(!empty($this->params['form']['filter_city_id1']) || (isset($this->params['form']['filter_city_id1']) && $this->params['form']['filter_city_id1'] == 0))
		//{
		//	$city_id = $this->params['form']['filter_city_id1'];
		//}
		//else
		//	$city_id = $this->Session->read("filter_city_id1");
		//$this->Session->write("filter_city_id1", $city_id);
		//if($city_id)
		//{
		//	$conditions["Project.city_id"] = $city_id;
		//	$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		//	//$projects = array();
		//}
		//else
		//{
		//	$districts = array();
		//	//$projects = array();
		//}
		//
		////filter district		
		//if(!empty($this->params['form']['filter_district_id1']) || (isset($this->params['form']['filter_district_id1']) && $this->params['form']['filter_district_id1'] == 0))
		//{
		//	$district_id = $this->params['form']['filter_district_id1'];
		//}
		//else
		//	$district_id = $this->Session->read("filter_district_id1");
		//$this->Session->write("filter_district_id1", $district_id);
		//
		//$districts = $this->Project->District->find('all',array('conditions'=>array('District.city_id'=>$city_id)));
		//if($district_id)
		//{
		//	$conditions["Project.district_id"] = $district_id;
		//}		
		//
		////filter keyword		
		//if(!empty($this->params['form']['filter_keyword1']) || (isset($this->params['form']['filter_keyword1']) && $this->params['form']['filter_keyword1'] == ''))
		//{
		//	$keyword = $this->params['form']['filter_keyword1'];
		//}
		//else
		//	$keyword = $this->Session->read("filter_keyword1");
		//$this->Session->write("filter_keyword1", $keyword);
		//if($keyword != '')
		//{
		//	$conditions["Project.name LIKE ?"] = '%'.$keyword.'%';			
		//}		
		
		
		$this->paginate = array('conditions'=>$conditions);
		$projects = $this->paginate();
		
		
		foreach($projects as $key => $p)
		{
			$image = $this->Project->ProjectImage->find('first', array(
									'conditions'=>array(
										'ProjectImage.project_id'=>$p["Project"]["id"]
									)
								));
			$projects[$key]['ProjectImage'] = $image["ProjectImage"];
			$projects[$key]['Project']['link'] = array('manager'=>false, 'controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Project"]["name"])));
		}
		$cities = $this->Project->City->find('all');
		$this->set('projects', $projects);
		//$this->set('cities', $cities);
		//$this->set('city_id', $city_id);
		//$this->set('districts', $districts);
		//$this->set('district_id', $district_id);		
		//$this->set('keyword', $keyword);	
	}

	function manager_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		//Image list
		$images = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$id)));
		
		
		$this->set('images', $images);
		$this->set('project', $this->Project->read(null, $id));
	}

	function manager_add() {
		$user = $this->Auth->user();
		
		
		
		$user = $this->Auth->user();
		$conditions = array('Project.user_id'=>$user["User"]["id"]);
		$count_p = $this->Project->find('all', array('conditions'=>$conditions));
		if(count($count_p) >= 2)
		{
			$this->Session->setFlash(__('Bạn chỉ được tạo tối đa 2 dự án', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			//convert number
			//$this->data["Project"]["lot_area"] = str_replace(",", "", $this->data["Product"]["lot_area"]);
			//$this->data["Product"]["property_area"] = str_replace(",", "", $this->data["Product"]["property_area"]);
			//$this->data["Product"]["area_x"] = str_replace(",", "", $this->data["Product"]["area_x"]);
			//$this->data["Product"]["area_y"] = str_replace(",", "", $this->data["Product"]["area_y"]);
			
			
			$this->data["Project"]["user_id"] = $user["User"]["id"];
			
			
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('Dự án đã được thêm.', true));
				
				
				//save images
				foreach($this->data["ProjectImage"] as $item)
				{
					if($item["filename"] != "")
					{
						$image["ProjectImage"] = $item;
						$image["ProjectImage"]["title"] = $this->data["Project"]["name"];
						$image["ProjectImage"]["project_id"] = $this->Project->id;
						
						$this->Project->ProjectImage->create();
						if ($this->Project->ProjectImage->save($image["ProjectImage"])) {
							//$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
				}
				
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		$this->data["Project"]["city_id"] = 1;
		$dits = $this->Project->District->find('list', array("conditions"=>array("city_id"=>1)));
		//$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		$cities = $this->Project->City->find('list');
		$pcs = $this->Project->ProjectCategory->find('list');
		$projectCategories[0] = "- ".__('khác', true)." -";
		foreach($pcs as $key => $value)
		{
			$projectCategories[$key] = $value;
		}
		$this->set(compact('districts', 'cities', 'projectCategories'));
	}

	function manager_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Project->User->isUserProject($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this project', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('Dự án đã được chỉnh sửa', true));
				
				
				//save images
				foreach($this->data["ProjectImage"] as $item)
				{
					if($item["filename"] != "")
					{
						$image["ProjectImage"] = $item;
						$image["ProjectImage"]["title"] = $this->data["Project"]["name"];
						$image["ProjectImage"]["project_id"] = $this->Project->id;
						
						$this->Project->ProjectImage->create();
						if ($this->Project->ProjectImage->save($image["ProjectImage"])) {
							//$this->Session->setFlash(__('The Image has been saved', true));
							//$this->redirect(array('action' => 'index'));
						} else {
							//$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
						}
					}
				}
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$dits = $this->Project->District->find('list', array("conditions"=>array("city_id"=>$this->data["Project"]["city_id"])));			
		$districts[0] = "- ".__('choose one', true)." -";
		foreach($dits as $key => $value)
		{
			$districts[$key] = $value;
		}
		
		//Image list
		$images['real'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$this->data["Project"]["id"],'ProjectImage.type'=>1)));
		$images['design'] = $this->Project->ProjectImage->find('all', array('conditions'=>array('ProjectImage.project_id'=>$this->data["Project"]["id"],'ProjectImage.type'=>2)));
		$cities = $this->Project->City->find('list');
		$pcs = $this->Project->ProjectCategory->find('list');
		//$projectCategories[0] = "- ".__('khác', true)." -";
		foreach($pcs as $key => $value)
		{
			$projectCategories[$key] = $value;
		}
		$this->set(compact('districts', 'cities', 'images', 'projectCategories'));
	}

	function manager_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//check if user has role on this product
			$user = $this->Auth->user();		
			if(!$this->Project->User->isUserProject($user["User"]["id"], $id))
			{
				$this->Session->setFlash(__('Manager doesn\'t has role on this product', true));
				$this->redirect(array('action' => 'index'));
				//echo "sfsdfsdfsdfs";
			}
		
		
		if ($this->Project->delete($id)) {
			$this->Session->setFlash(__('Đã xóa dự án', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajaxProjectOption($district_id)
	{
		//echo $city_id;
		$projects = $this->Project->find("all", array("conditions"=>array("Project.district_id"=>$district_id)));
		//echo count($districts);
		$this->set(compact('projects'));
		$this->layout = null;
	}
	
	function ajaxProjectAddress($project_id)
	{
		//echo $city_id;
		$project = $this->Project->find("first", array("conditions"=>array("Project.id"=>$project_id)));
		//echo count($districts);
		$this->set(compact('project'));
		$this->layout = null;
	}
	
	function admin_topnew($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project', true));
			$this->redirect(array('action'=>'index'));
		}
		$Project = $this->Project->read(null, $id);
		$Project["Project"]["new"] = !$Project["Project"]["new"] ? 1 : 0;
		if ($this->Project->save($Project)) {
			$this->Session->setFlash(__('The project has been saved', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function getNewProjects()
	{
		$newProjects = $this->Project->find('all', array(
							'conditions'=>array(
								'Project.new'=>1
							),
							'limit' => 6
						));
		foreach($newProjects as $key => $p)
		{
			Controller::loadModel('UserProfile');
			$image = $this->Project->ProjectImage->find('first', array(
									'conditions'=>array(
										'ProjectImage.project_id'=>$p["Project"]["id"]
									)
								));
			$profile = $this->UserProfile->find('first', array(
									'conditions'=>array(
										'UserProfile.user_id'=>$p["Project"]["user_id"]
									)
								));
			//var_dump($profile);
			$newProjects[$key]['ProjectImage'] = $image["ProjectImage"];
			$newProjects[$key]['Project']['sname'] = parent::snippet(strip_tags($p["Project"]["name"]), 30);
			$newProjects[$key]['UserProfile'] = $profile["UserProfile"];
			//var_dump($profile["ProfileImage"]);
			if(isset($profile["UserImage"])) $newProjects[$key]['UserImage'] = $profile["UserImage"];
			$newProjects[$key]["Project"]["sdescription"] = parent::snippet(strip_tags($p["Project"]["description"]), 200);
			$newProjects[$key]["Project"]["link"] = array('controller'=>'projects', 'action'=>'details',
													     'city'=>strtolower(Inflector::slug($p["City"]["name"])),
													     'id'=>$p["Project"]["id"],
													     'name'=>strtolower(Inflector::slug($p["Project"]["name"])));
		}
		return $newProjects;
	}
}
