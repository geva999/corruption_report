<?php
class Expert extends AppModel {

	var $name = 'Expert';
	var $validate = array(
		'username' => array('rule' => 'notempty', 'message' => 'Логин не может быть пустым'),
		'password' => array('rule' => 'notempty', 'message' => 'Пароль не может быть пустым'),
		'fullname' => array('rule' => 'notempty', 'message' => 'Имя не может быть пустым')
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