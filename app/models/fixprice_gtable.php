<?php
class FixpriceGtable extends AppModel {
	var $name = 'FixpriceGtable';
	var $displayField = 'fixprice_order_id';
	var $validate = array(
		'fixprice_order_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		//'ground_in' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
		//'ground_out' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
		//'build_in' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
		//'build_out' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
		//'use_in' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
		//'use_out' => array(
		//	'numeric' => array(
		//		'rule' => array('numeric'),
		//		//'message' => 'Your custom message here',
		//		//'allowEmpty' => false,
		//		//'required' => false,
		//		//'last' => false, // Stop validation after this rule
		//		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FixpriceOrder' => array(
			'className' => 'FixpriceOrder',
			'foreignKey' => 'fixprice_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
