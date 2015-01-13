<?php
/* UserImage Test cases generated on: 2011-10-25 11:43:09 : 1319535789*/
App::import('Model', 'UserImage');

class UserImageTestCase extends CakeTestCase {
	var $fixtures = array('app.user_image', 'app.user_profile', 'app.user', 'app.group', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->UserImage =& ClassRegistry::init('UserImage');
	}

	function endTest() {
		unset($this->UserImage);
		ClassRegistry::flush();
	}

}
