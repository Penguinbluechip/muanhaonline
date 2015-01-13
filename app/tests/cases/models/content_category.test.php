<?php
/* ContentCategory Test cases generated on: 2011-11-02 02:45:01 : 1320198301*/
App::import('Model', 'ContentCategory');

class ContentCategoryTestCase extends CakeTestCase {
	var $fixtures = array('app.content_category', 'app.content');

	function startTest() {
		$this->ContentCategory =& ClassRegistry::init('ContentCategory');
	}

	function endTest() {
		unset($this->ContentCategory);
		ClassRegistry::flush();
	}

}
