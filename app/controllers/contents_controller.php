<?php
class ContentsController extends AppController {

	var $name = 'Contents';
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('details', 'index', 'slogan', 'category', 'getCategoryNewses', 'getHomeNewses');
        }
	
	function index()
	{
		$this->layout = 'home';

		$tt_sks = $this->Content->find("all", array(
							'conditions'=>array(
									'Content.content_category_id'=>'2'
								),
							'limit'=>5,
							'order'=>'Content.create_date DESC'
							)
					       );
		foreach($tt_sks as $key => $p)
		{
			$tt_sks[$key]["Content"]["name"] = parent::snippet(strip_tags($p["Content"]["name"]), 60);
			$tt_sks[$key]["Content"]["create_date"] = parent::dateFormat_news($p["Content"]["create_date"]);
			$tt_sks[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 100);
			$tt_sks[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
			$tt_sks[$key]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details',
							     'id'=>$p["Content"]["id"],
							     'category'=>strtolower(Inflector::slug($p["ContentCategory"]["name"])),
							     'name'=>strtolower(Inflector::slug($p["Content"]["name"])));
		}
		
		$cats = $this->Content->ContentCategory->find('all', array(
									'conditions'=>array(
										'ContentCategory.id >'=>2									
									),
									'order'=>'ContentCategory.order'
								)
							);
		
		foreach($cats as $tt => $cat)
		{
			$pts = $this->Content->find("all", array(
							'conditions'=>array(
									'Content.content_category_id'=>$cat['ContentCategory']['id']
								),
							'limit'=>4,
							'order'=>'Content.create_date DESC'
							)
					       );
			foreach($pts as $key => $p)
			{
				$pts[$key]["Content"]["name"] = parent::snippet(strip_tags($p["Content"]["name"]), 60);
				$pts[$key]["Content"]["create_date"] = parent::dateFormat_news($p["Content"]["create_date"]);
				$pts[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 100);
				$pts[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
				$pts[$key]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details',
								     'id'=>$p["Content"]["id"],
								     'category'=>strtolower(Inflector::slug($p["ContentCategory"]["name"])),
								     'name'=>strtolower(Inflector::slug($p["Content"]["name"])));
			}
			
			$cats[$tt]['items'] = $pts;
		}
		
		
		
		
		$this->set('tt_sks', $tt_sks);
		$this->set('cats', $cats);
		$this->set('page_title', "Tin tức - MuaNhaOnline.vn");

	}
	
	function getCategoryNewses($id)
	{
		$newses = $this->Content->find("all", array(
							'conditions'=>array(
									'Content.content_category_id'=>$id
								),
							'limit'=>6,
							'order'=>'Content.create_date DESC'
							)
					       );
		foreach($newses as $key => $p)
		{
			$newses[$key]["Content"]["name"] = parent::snippet(strip_tags($p["Content"]["name"]), 80);
			$newses[$key]["Content"]["create_date"] = parent::dateFormat_news($p["Content"]["create_date"]);
		    $newses[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 100);
		    $newses[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
		    $newses[$key]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details',
							     'id'=>$p["Content"]["id"],
							     'category'=>strtolower(Inflector::slug($p["ContentCategory"]["name"])),
							     'name'=>strtolower(Inflector::slug($p["Content"]["name"])));
		}
		return $newses;
	}
	
	function getHomeNewses()
	{
		$newses = $this->Content->find("all", array(
							'conditions'=>array('Content.content_category_id !=' => 1),
							'limit'=>10,
							'order'=>'Content.create_date DESC'
							)
					       );
		foreach($newses as $key => $p)
		{
			$newses[$key]["Content"]["name"] = parent::snippet(strip_tags($p["Content"]["name"]), 200);
			$newses[$key]["Content"]["create_date"] = parent::dateFormat_news($p["Content"]["create_date"]);
		    $newses[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 100);
		    $newses[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
		    $newses[$key]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details',
							     'id'=>$p["Content"]["id"],
							     'category'=>strtolower(Inflector::slug($p["ContentCategory"]["name"])),
							     'name'=>strtolower(Inflector::slug($p["Content"]["name"])));
		}
		return $newses;
	}
	
	function details($id = null)
	{
		$this->layout = "home";
		if (!$id) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$content = $this->Content->read(null, $id);
		$content["Content"]["create_date"] = parent::dateFormat_news($content["Content"]["create_date"]);
		
		$newContents = $this->Content->find('all', array(
							'conditions'=>array(
								'Content.content_category_id'=>$content['Content']['content_category_id'],
								'Content.id !='=>$content['Content']['id']
							),
							'limit'=>10,
							'order'=>'Content.create_date DESC'
						));
		foreach($newContents as $c => $p)
		{
			
			$newContents[$c]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details',
							     'id'=>$p["Content"]["id"],
							     'category'=>strtolower(Inflector::slug($p["ContentCategory"]["name"])),
							     'name'=>strtolower(Inflector::slug($p["Content"]["name"])));
		}
		
		$this->set('meta_description', substr(trim(preg_replace('/\s+/', ' ', strip_tags($content["Content"]["content"]))),0,250));
		//echo count($newContents);
		$this->set('content', $content);
		$this->set('newContents', $newContents);
		$this->set('page_title', $content["Content"]["name"]);
	}
	
	function category($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Content->recursive = 0;
		$this->layout = "home";
		$cat = $this->Content->ContentCategory->read(null, $id);
		
		$conditions = array('Content.content_category_id'=>$id);		
		
		//var_dump($this->params);
		if(count($conditions))
		{
			$this->paginate = array(
				'conditions' => $conditions,
				'limit'=>10,
				'order'=>'Content.create_date DESC'
			);
		}
		
		$contents = $this->paginate();
		foreach($contents as $key => $p)
		{
		    $contents[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 200);
		    $contents[$key]["Content"]["create_date"] = parent::dateFormat_news($p["Content"]["create_date"]);
		    $contents[$key]["Content"]["image"] = parent::getImage($p["Content"]["content"]);
		    $contents[$key]["Content"]["link"] = array('controller'=>'contents', 'action'=>'details', $p["Content"]["id"]);
		}
		
		$this->set('contents', $contents);
		//$this->set('cat_id', $cat_id);
		$this->set('cat', $cat);
	}
	
	function slogan()
	{
		$slogan = $this->Content->find("first", array(
							'conditions'=>array(									
									'Content.id'=>'3'
							)
						)
				);		
		
		return $slogan;
	}

	function admin_index() {
		$this->Content->recursive = 0;
		
		$conditions = array();
		
		//filter content category id
		$cats = $this->Content->ContentCategory->find('all');
		//$city_id = $this->Session->read("districts_city_id") ? $this->Session->read("districts_city_id"): "";
		if(!empty($this->params['form']['filter_cat_id']))
			$cat_id = $this->params['form']['filter_cat_id'];
		else
			$cat_id = $this->Session->read("filter_cat_id");
		
		$this->Session->write("filter_cat_id", $cat_id);
		
		if($cat_id && $cat_id != "all")
		{
			$conditions["Content.content_category_id"] = $cat_id;			
		}
		//echo $this->Session->read("districts_city_id");
		
		//var_dump($this->params);
		if(count($conditions))
		{
			$this->paginate = array(
				'conditions' => $conditions,
				'order' => 'Content.create_date DESC'
			);
		}
		
		$contents = $this->paginate();
		foreach($contents as $key => $p)
		{
		    $contents[$key]["Content"]["content"] = parent::snippet(strip_tags($p["Content"]["content"]), 100);		    
		}
		
		$this->set('contents', $contents);
		$this->set('cat_id', $cat_id);
		$this->set('cats', $cats);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('content', $this->Content->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
		$contentCategories = $this->Content->ContentCategory->find('list');
		$this->set(compact('contentCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
		$contentCategories = $this->Content->ContentCategory->find('list');
		$this->set(compact('contentCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for content', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Content->delete($id)) {
			$this->Session->setFlash(__('Content deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Content was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
