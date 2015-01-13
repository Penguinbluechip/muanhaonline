<?php
/* UserImages Test cases generated on: 2011-10-25 11:43:25 : 1319535805*/
App::import('Controller', 'UserImages');

class TestUserImagesController extends UserImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_image', 'app.user_profile', 'app.user', 'app.group', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->UserImages =& new TestUserImagesController();
		$this->UserImages->constructClasses();
	}

	function endTest() {
		unset($this->UserImages);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
