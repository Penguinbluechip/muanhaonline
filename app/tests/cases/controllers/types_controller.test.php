<?php
/* Types Test cases generated on: 2011-10-17 09:03:26 : 1318835006*/
App::import('Controller', 'Types');

class TestTypesController extends TypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.type', 'app.category');

	function startTest() {
		$this->Types =& new TestTypesController();
		$this->Types->constructClasses();
	}

	function endTest() {
		unset($this->Types);
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
