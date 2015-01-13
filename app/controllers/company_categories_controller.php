<?php
class CompanyCategoriesController extends AppController {

	var $name = 'CompanyCategories';
	
	public function beforeFilter() {
		$this->Auth->allow('getAll');
	}
	
	function getAll()
	{
		return $this->CompanyCategory->find("all");
		
	}

	function admin_index() {
		$this->CompanyCategory->recursive = 0;
		$this->set('companyCategories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid company category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('companyCategory', $this->CompanyCategory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CompanyCategory->create();
			if ($this->CompanyCategory->save($this->data)) {
				$this->Session->setFlash(__('The company category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company category could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid company category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CompanyCategory->save($this->data)) {
				$this->Session->setFlash(__('The company category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CompanyCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for company category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CompanyCategory->delete($id)) {
			$this->Session->setFlash(__('Company category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Company category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
