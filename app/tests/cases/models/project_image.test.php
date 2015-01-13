<?php
/* ProjectImage Test cases generated on: 2011-10-31 02:22:43 : 1320024163*/
App::import('Model', 'ProjectImage');

class ProjectImageTestCase extends CakeTestCase {
	var $fixtures = array('app.project_image', 'app.project', 'app.city', 'app.district');

	function startTest() {
		$this->ProjectImage =& ClassRegistry::init('ProjectImage');
	}

	function endTest() {
		unset($this->ProjectImage);
		ClassRegistry::flush();
	}

}
