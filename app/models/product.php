<?php
class Product extends AppModel {
	var $name = 'Product';
	var $displayField = 'name';
	var $order = 'Product.create_date DESC';
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'district_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'certificate_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'property_area' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lot_area' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'floors' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'build_area' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống'
			),
		),
		'expire_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'create_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ward' => array(
			'className' => 'Ward',
			'foreignKey' => 'ward_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Street' => array(
			'className' => 'Street',
			'foreignKey' => 'street_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Certificate' => array(
			'className' => 'Certificate',
			'foreignKey' => 'certificate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CurrencyPrice' => array(
			'className' => 'Currency',
			'foreignKey' => 'price_currency',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CurrencyCommission' => array(
			'className' => 'Currency',
			'foreignKey' => 'commission_currency',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OccupantType' => array(
			'className' => 'OccupantType',
			'foreignKey' => 'occupant_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'ProductImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductComment' => array(
			'className' => 'ProductComment',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Favorite' => array(
			'className' => 'Favorite',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public static function getProductTitle($p, $id = false, $type = false)
	{
		if($id)
		{
			$db = new Product();
			$p = $db->read(null, $p);
		}
		
		$sstreet = $p["Street"]["name"] ? " - ".$p["Street"]["name"] : '';
		$facade = $p["Product"]["facade"] ? " - ".$p["Product"]["facade"] : '';
		$type = $type ? " - ".$type : "";
		return $p["Type"]["name"].$facade.$sstreet." - ".$p["District"]["name"]." - ".$p["City"]["name"].$type;
	}
}
