<?php
class NganluongController extends AppController {

	var $name = 'Nganluong';
	var $uses = array();
	
	public function beforeFilter() {
		$this->Auth->allow('index');
	}
        
        public function index()
        {
            $this->layout = null;            
            return;
        }
}
