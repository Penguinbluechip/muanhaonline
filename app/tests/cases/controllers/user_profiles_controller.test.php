<?php
/* UserProfiles Test cases generated on: 2011-10-24 04:31:32 : 1319423492*/
App::import('Controller', 'UserProfiles');

class TestUserProfilesController extends UserProfilesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserProfilesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_profile', 'app.user', 'app.group', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->UserProfiles =& new TestUserProfilesController();
		$this->UserProfiles->constructClasses();
	}

	function endTest() {
		unset($this->UserProfiles);
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
