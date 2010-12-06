<?php
class Project extends AppModel {

	var $name = 'Project';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Имя не может быть пустым'),
		'reportnumber' => array('rule' => 'numeric', 'message' => 'Номер не может быть пустым или уже существует заключение под тем же номером'),
		'projectdatetext' => array('rule' => 'notempty', 'message' => 'Дата не может быть пустой'),
		'numberpages' => array('rule' => 'numeric', 'message' => 'Число страниц не может быть пустым'),
		'datelimitexperttext' => array('rule' => 'notempty', 'message' => 'Предельный срок для эксперта не может быть пустым'),
		'datelimitparlamenttext' => array('rule' => 'notempty', 'message' => 'Предельный срок для Парламента не может быть пустым')
	);

	var $belongsTo = array(
			'Expert' => array(
								'className' => 'Expert',
								'foreignKey' => 'expert_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Author' => array(
								'className' => 'Author',
								'foreignKey' => 'author_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasOne = array(
			'Report' => array('className' => 'Report',
								'foreignKey' => 'project_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	var $hasMany = array(
			'Projectexpert' => array('className' => 'Projectexpert',
								'foreignKey' => 'project_id',
								'dependent' => true,
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