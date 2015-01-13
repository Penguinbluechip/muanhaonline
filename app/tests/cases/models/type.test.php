<?php
/* Type Test cases generated on: 2011-10-17 09:02:30 : 1318834950*/
App::import('Model', 'Type');

class TypeTestCase extends CakeTestCase {
	var $fixtures = array('app.type', 'app.category');

	function startTest() {
		$this->Type =& ClassRegistry::init('Type');
	}

	function endTest() {
		unset($this->Type);
		ClassRegistry::flush();
	}

}
