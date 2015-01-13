<?php
class FixpriceOrderState extends AppModel {
	var $name = 'FixpriceOrderState';
	var $displayField = 'name';
	var $validate = array(
		'alias' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	var $hasAndBelongsToMany = array(		
		'FixpriceOrder' => array(
			'className' => 'FixpriceOrder',
			'joinTable' => 'fixprice_orders_states',
			'foreignKey' => 'fixprice_order_state_id',
			'associationForeignKey' => 'fixprice_order_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
}
