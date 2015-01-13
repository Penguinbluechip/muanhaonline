<?php
/* District Fixture generated on: 2011-10-17 05:04:21 : 1318820661 */
class DistrictFixture extends CakeTestFixture {
	var $name = 'District';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'alias' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'city_id' => 1,
			'name' => 1,
			'alias' => 1,
			'order' => 1
		),
	);
}
