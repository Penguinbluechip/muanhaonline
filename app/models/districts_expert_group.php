<?php
class DistrictsExpertGroup extends AppModel {
	var $name = 'DistrictsExpertGroup';
	var $displayField = 'expert_group_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ExpertGroup' => array(
			'className' => 'ExpertGroup',
			'foreignKey' => 'expert_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
