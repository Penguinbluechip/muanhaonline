<?php
/* Projects Test cases generated on: 2011-10-17 11:06:54 : 1318842414*/
App::import('Controller', 'Projects');

class TestProjectsController extends ProjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.project', 'app.district', 'app.city');

	function startTest() {
		$this->Projects =& new TestProjectsController();
		$this->Projects->constructClasses();
	}

	function endTest() {
		unset($this->Projects);
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
