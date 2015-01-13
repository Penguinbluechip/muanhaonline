<?php
/* ProductsComments Test cases generated on: 2011-11-09 06:40:47 : 1320820847*/
App::import('Controller', 'ProductsComments');

class TestProductsCommentsController extends ProductsCommentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductsCommentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.products_comment', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->ProductsComments =& new TestProductsCommentsController();
		$this->ProductsComments->constructClasses();
	}

	function endTest() {
		unset($this->ProductsComments);
		ClassRegistry::flush();
	}

	function testUserIndex() {

	}

	function testUserView() {

	}

	function testUserAdd() {

	}

	function testUserEdit() {

	}

	function testUserDelete() {

	}

}
