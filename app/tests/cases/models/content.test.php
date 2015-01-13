<?php
/* Content Test cases generated on: 2011-11-02 02:47:07 : 1320198427*/
App::import('Model', 'Content');

class ContentTestCase extends CakeTestCase {
	var $fixtures = array('app.content');

	function startTest() {
		$this->Content =& ClassRegistry::init('Content');
	}

	function endTest() {
		unset($this->Content);
		ClassRegistry::flush();
	}

}
