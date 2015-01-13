<?php
/* Certificates Test cases generated on: 2011-10-17 12:18:58 : 1318846738*/
App::import('Controller', 'Certificates');

class TestCertificatesController extends CertificatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CertificatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.certificate');

	function startTest() {
		$this->Certificates =& new TestCertificatesController();
		$this->Certificates->constructClasses();
	}

	function endTest() {
		unset($this->Certificates);
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
