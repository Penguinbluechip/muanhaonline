<?php
/* ProductImage Test cases generated on: 2011-10-19 04:57:52 : 1318993072*/
App::import('Model', 'ProductImage');

class ProductImageTestCase extends CakeTestCase {
	var $fixtures = array('app.product_image', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.user', 'app.group', 'app.currency');

	function startTest() {
		$this->ProductImage =& ClassRegistry::init('ProductImage');
	}

	function endTest() {
		unset($this->ProductImage);
		ClassRegistry::flush();
	}

}
