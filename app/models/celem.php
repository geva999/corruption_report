<?php
class Celem extends AppModel {

	var $name = 'Celem';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Numele nu poate să fie nul'),
		'number' => array('rule' => 'notempty', 'message' => 'Numărul nu poate să fie nul')
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
			'Pelem' => array('className' => 'Pelem',
								'foreignKey' => 'celem_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Subreport' => array('className' => 'Subreport',
						'joinTable' => 'subreports_celems',
						'foreignKey' => 'celem_id',
						'associationForeignKey' => 'subreport_id',
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
?>