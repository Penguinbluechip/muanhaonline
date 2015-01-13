<?php
/* ProductsComment Test cases generated on: 2011-11-09 06:39:44 : 1320820784*/
App::import('Model', 'ProductsComment');

class ProductsCommentTestCase extends CakeTestCase {
	var $fixtures = array('app.products_comment', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->ProductsComment =& ClassRegistry::init('ProductsComment');
	}

	function endTest() {
		unset($this->ProductsComment);
		ClassRegistry::flush();
	}

}
