<?php
class Projectexpert extends AppModel {

	var $name = 'Projectexpert';
	
	var $belongsTo = array(
			'Project' => array(
								'className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>