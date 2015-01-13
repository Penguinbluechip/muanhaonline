<?php
/* Districts Test cases generated on: 2011-10-17 05:05:01 : 1318820701*/
App::import('Controller', 'Districts');

class TestDistrictsController extends DistrictsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DistrictsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.district', 'app.city');

	function startTest() {
		$this->Districts =& new TestDistrictsController();
		$this->Districts->constructClasses();
	}

	function endTest() {
		unset($this->Districts);
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
