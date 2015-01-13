<?php
/* Currency Test cases generated on: 2011-10-18 03:27:08 : 1318901228*/
App::import('Model', 'Currency');

class CurrencyTestCase extends CakeTestCase {
	var $fixtures = array('app.currency');

	function startTest() {
		$this->Currency =& ClassRegistry::init('Currency');
	}

	function endTest() {
		unset($this->Currency);
		ClassRegistry::flush();
	}

}
