<?php
/* Currencies Test cases generated on: 2011-10-18 03:27:27 : 1318901247*/
App::import('Controller', 'Currencies');

class TestCurrenciesController extends CurrenciesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CurrenciesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.currency');

	function startTest() {
		$this->Currencies =& new TestCurrenciesController();
		$this->Currencies->constructClasses();
	}

	function endTest() {
		unset($this->Currencies);
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
