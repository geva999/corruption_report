<?php
class Project extends AppModel {

	var $name = 'Project';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Numele nu poate să fie nul'),
		'reportnumber' => array('rule' => 'numeric', 'message' => 'Numarul nu poate să fie nul sau există deja un raport cu acelaşi număr'),
		'projectdatetext' => array('rule' => 'notempty', 'message' => 'Data nu poate să fie nulă'),
		'numberpages' => array('rule' => 'numeric', 'message' => 'Numarul de pagini nu poate să fie nul'),
		'numberprojectsstandard' => array('rule' => 'numeric', 'message' => 'Numarul de proiecte standart nu poate să fie nul'),
		'datelimitexperttext' => array('rule' => 'notempty', 'message' => 'Data limită pentru expert nu poate să fie nulă'),
		'datelimitparlamenttext' => array('rule' => 'notempty', 'message' => 'Data limită pentru parlament nu poate să fie nulă')
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