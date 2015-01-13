<?php
/* Project Fixture generated on: 2011-10-17 11:06:32 : 1318842392 */
class ProjectFixture extends CakeTestFixture {
	var $name = 'Project';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'district_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'street' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'home_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'longitude' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'latitude' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'city_id' => 1,
			'district_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'street' => 'Lorem ipsum dolor sit amet',
			'home_number' => 'Lorem ipsum dolor sit amet',
			'longitude' => 'Lorem ipsum dolor sit amet',
			'latitude' => 'Lorem ipsum dolor sit amet'
		),
	);
}
