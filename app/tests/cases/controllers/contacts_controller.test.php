<?php
/* Contacts Test cases generated on: 2011-10-26 04:40:02 : 1319596802*/
App::import('Controller', 'Contacts');

class TestContactsController extends ContactsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContactsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.contact');

	function startTest() {
		$this->Contacts =& new TestContactsController();
		$this->Contacts->constructClasses();
	}

	function endTest() {
		unset($this->Contacts);
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
