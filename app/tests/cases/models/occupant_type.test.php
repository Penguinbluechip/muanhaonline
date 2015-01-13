<?php
/* OccupantType Test cases generated on: 2011-10-21 04:01:34 : 1319162494*/
App::import('Model', 'OccupantType');

class OccupantTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.occupant_type', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.user', 'app.group', 'app.currency', 'app.product_image');

	function startTest() {
		$this->OccupantType =& ClassRegistry::init('OccupantType');
	}

	function endTest() {
		unset($this->OccupantType);
		ClassRegistry::flush();
	}

}
