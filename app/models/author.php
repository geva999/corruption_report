<?php
class Author extends AppModel {

	var $name = 'Author';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Имя не может быть пустым')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'author_id',
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