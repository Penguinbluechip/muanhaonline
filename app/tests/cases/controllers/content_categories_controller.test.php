<?php
/* ContentCategories Test cases generated on: 2011-11-02 02:45:27 : 1320198327*/
App::import('Controller', 'ContentCategories');

class TestContentCategoriesController extends ContentCategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContentCategoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.content_category', 'app.content');

	function startTest() {
		$this->ContentCategories =& new TestContentCategoriesController();
		$this->ContentCategories->constructClasses();
	}

	function endTest() {
		unset($this->ContentCategories);
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
