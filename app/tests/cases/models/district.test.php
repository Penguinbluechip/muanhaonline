<?php
/* District Test cases generated on: 2011-10-17 05:04:21 : 1318820661*/
App::import('Model', 'District');

class DistrictTestCase extends CakeTestCase {
	var $fixtures = array('app.district', 'app.city');

	function startTest() {
		$this->District =& ClassRegistry::init('District');
	}

	function endTest() {
		unset($this->District);
		ClassRegistry::flush();
	}

}
