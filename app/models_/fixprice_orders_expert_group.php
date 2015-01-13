<?php
class FixpriceOrdersExpertGroup extends AppModel {
	var $name = 'FixpriceOrdersExpertGroup';
	var $displayField = 'fixprice_order_id';
	var $validate = array(
		'expert_group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ExpertGroup' => array(
			'className' => 'ExpertGroup',
			'foreignKey' => 'expert_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FixpriceOrder' => array(
			'className' => 'FixpriceOrder',
			'foreignKey' => 'fixprice_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
