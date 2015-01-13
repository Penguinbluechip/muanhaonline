<?php
/* Certificate Test cases generated on: 2011-10-17 12:18:44 : 1318846724*/
App::import('Model', 'Certificate');

class CertificateTestCase extends CakeTestCase {
	var $fixtures = array('app.certificate');

	function startTest() {
		$this->Certificate =& ClassRegistry::init('Certificate');
	}

	function endTest() {
		unset($this->Certificate);
		ClassRegistry::flush();
	}

}
