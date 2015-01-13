<?php
/* OccupantTypes Test cases generated on: 2011-10-21 04:01:53 : 1319162513*/
App::import('Controller', 'OccupantTypes');

class TestOccupantTypesController extends OccupantTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OccupantTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.occupant_type', 'app.product', 'app.type', 'app.category', 'app.city', 'app.district', 'app.project', 'app.certificate', 'app.user', 'app.group', 'app.currency', 'app.product_image');

	function startTest() {
		$this->OccupantTypes =& new TestOccupantTypesController();
		$this->OccupantTypes->constructClasses();
	}

	function endTest() {
		unset($this->OccupantTypes);
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
