<?php
class Expert extends AppModel {

	var $name = 'Expert';
	var $validate = array(
		'username' => array('rule' => 'notempty', 'message' => 'Login-ul nu poate să fie nul'),
		'password' => array('rule' => 'notempty', 'message' => 'Parola nu poate să fie nulă'),
		'fullname' => array('rule' => 'notempty', 'message' => 'Numele nu poate să fie nul')
	);

	var $hasMany = array(
			'Project' => array('className' => 'Project',
								'foreignKey' => 'expert_id',
								'dependent' => false,
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

}
?>