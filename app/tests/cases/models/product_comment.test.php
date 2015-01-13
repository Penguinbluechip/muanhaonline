<?php
/* ProductComment Test cases generated on: 2011-11-09 06:47:01 : 1320821221*/
App::import('Model', 'ProductComment');

class ProductCommentTestCase extends CakeTestCase {
	var $fixtures = array('app.product_comment', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->ProductComment =& ClassRegistry::init('ProductComment');
	}

	function endTest() {
		unset($this->ProductComment);
		ClassRegistry::flush();
	}

}
