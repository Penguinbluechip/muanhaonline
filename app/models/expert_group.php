<?php
class ExpertGroup extends AppModel {
	var $name = 'ExpertGroup';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'District' => array(
			'className' => 'District',
			'joinTable' => 'districts_expert_groups',
			'foreignKey' => 'expert_group_id',
			'associationForeignKey' => 'district_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'joinTable' => 'expert_groups_users',
			'foreignKey' => 'expert_group_id',
			'associationForeignKey' => 'user_id',
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
	
	var $belongsTo = array(
		'Expert' => array(
			'className' => 'User',
			'foreignKey' => 'expert_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
}
