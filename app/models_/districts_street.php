<?php
class DistrictsStreet extends AppModel {
	var $name = 'DistrictsStreet';
	var $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
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
		)
	);
}
