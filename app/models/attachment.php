<?php
class Attachment extends AppModel {

	var $name = 'Attachment';
	var $validate = array(
		'report_id' => array('numeric')
	);

	var $belongsTo = array(
			'Report' => array('className' => 'Report',
								'foreignKey' => 'report_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>