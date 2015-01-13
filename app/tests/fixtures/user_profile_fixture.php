<?php
/* UserProfile Fixture generated on: 2011-10-24 04:31:13 : 1319423473 */
class UserProfileFixture extends CakeTestFixture {
	var $name = 'UserProfile';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'birthday' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'personal_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'mobile' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'address' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'birthday' => '2011-10-24 04:31:13',
			'personal_id' => 'Lorem ipsum dolor sit amet',
			'mobile' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
