<?php
/* Products Test cases generated on: 2011-10-19 04:08:52 : 1318990132*/
App::import('Controller', 'Products');

class TestProductsController extends ProductsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.user', 'app.group', 'app.currency');

	function startTest() {
		$this->Products =& new TestProductsController();
		$this->Products->constructClasses();
	}

	function endTest() {
		unset($this->Products);
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
