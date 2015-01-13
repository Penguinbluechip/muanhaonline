<?php
/* ProductImages Test cases generated on: 2011-10-19 04:58:23 : 1318993103*/
App::import('Controller', 'ProductImages');

class TestProductImagesController extends ProductImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_image', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.user', 'app.group', 'app.currency');

	function startTest() {
		$this->ProductImages =& new TestProductImagesController();
		$this->ProductImages->constructClasses();
	}

	function endTest() {
		unset($this->ProductImages);
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
