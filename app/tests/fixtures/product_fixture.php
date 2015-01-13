<?php
/* Product Fixture generated on: 2011-10-18 04:12:12 : 1318903932 */
class ProductFixture extends CakeTestFixture {
	var $name = 'Product';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'district_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'certificate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'street' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'home_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'bedrooms' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'bathrooms' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'property_area' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'lot_area' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'floor' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'price' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'price_currency' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'price_perm2' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'commission' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf32_general_ci', 'charset' => 'utf32'),
		'commission_currency' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'expire_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'create_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'type_id' => 1,
			'category_id' => 1,
			'city_id' => 1,
			'district_id' => 1,
			'project_id' => 1,
			'certificate_id' => 1,
			'user_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'street' => 'Lorem ipsum dolor sit amet',
			'home_number' => 'Lorem ipsum dolor sit amet',
			'bedrooms' => 1,
			'bathrooms' => 1,
			'property_area' => 'Lorem ipsum dolor sit amet',
			'lot_area' => 'Lorem ipsum dolor sit amet',
			'floor' => 1,
			'price' => 'Lorem ipsum dolor sit amet',
			'price_currency' => 1,
			'price_perm2' => 1,
			'commission' => 'Lorem ipsum dolor sit amet',
			'commission_currency' => 1,
			'expire_date' => '2011-10-18 04:12:12',
			'create_date' => '2011-10-18 04:12:12'
		),
	);
}
