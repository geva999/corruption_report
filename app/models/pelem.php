<?php
class Pelem extends AppModel {

	var $name = 'Pelem';
	var $validate = array(
		'celem_id' => array('numeric'),
		'pelem' => array('rule' => 'notempty', 'message' => 'Numele nu poate să fie nul')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Celem' => array('className' => 'Celem',
								'foreignKey' => 'celem_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Subreport' => array('className' => 'Subreport',
						'joinTable' => 'subreports_pelems',
						'foreignKey' => 'pelem_id',
						'associationForeignKey' => 'subreport_id',
						'unique' => true,
						'conditions' => '',
						'fields' => 'Subreport.id, Subreport.report_id',
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