<?php
/* ProjectImages Test cases generated on: 2011-10-31 02:22:59 : 1320024179*/
App::import('Controller', 'ProjectImages');

class TestProjectImagesController extends ProjectImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjectImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.project_image', 'app.project', 'app.city', 'app.district');

	function startTest() {
		$this->ProjectImages =& new TestProjectImagesController();
		$this->ProjectImages->constructClasses();
	}

	function endTest() {
		unset($this->ProjectImages);
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
