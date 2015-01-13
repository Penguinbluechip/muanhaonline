<?php
/* UserProfile Test cases generated on: 2011-10-24 04:31:14 : 1319423474*/
App::import('Model', 'UserProfile');

class UserProfileTestCase extends CakeTestCase {
	var $fixtures = array('app.user_profile', 'app.user', 'app.group', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->UserProfile =& ClassRegistry::init('UserProfile');
	}

	function endTest() {
		unset($this->UserProfile);
		ClassRegistry::flush();
	}

}
