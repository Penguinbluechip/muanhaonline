<?php
/* Customers Test cases generated on: 2011-10-31 08:10:38 : 1320045038*/
App::import('Controller', 'Customers');

class TestCustomersController extends CustomersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CustomersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer', 'app.user', 'app.group', 'app.user_profile', 'app.user_image', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.project_image', 'app.certificate', 'app.currency', 'app.occupant_type', 'app.product_image');

	function startTest() {
		$this->Customers =& new TestCustomersController();
		$this->Customers->constructClasses();
	}

	function endTest() {
		unset($this->Customers);
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
