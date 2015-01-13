<?php
/* Customer Test cases generated on: 2011-10-31 08:10:23 : 1320045023*/
App::import('Model', 'Customer');

class CustomerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->Customer =& ClassRegistry::init('Customer');
	}

	function endTest() {
		unset($this->Customer);
		ClassRegistry::flush();
	}

}
