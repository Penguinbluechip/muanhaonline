<?php
/* ProductComments Test cases generated on: 2011-11-09 06:47:12 : 1320821232*/
App::import('Controller', 'ProductComments');

class TestProductCommentsController extends ProductCommentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductCommentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_comment', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->ProductComments =& new TestProductCommentsController();
		$this->ProductComments->constructClasses();
	}

	function endTest() {
		unset($this->ProductComments);
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
