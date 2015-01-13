<?php
/* Customer Fixture generated on: 2011-10-31 08:10:22 : 1320045022 */
class CustomerFixture extends CakeTestFixture {
	var $name = 'Customer';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'message' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'product_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
