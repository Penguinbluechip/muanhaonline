<?php
/* Currency Fixture generated on: 2011-10-18 03:27:08 : 1318901228 */
class CurrencyFixture extends CakeTestFixture {
	var $name = 'Currency';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'rate' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'rate' => 'Lorem ipsum dolor sit amet'
		),
	);
}
