<?php
class Template extends AppModel {

	var $name = 'Template';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Имя не может быть пустым')
	);

}
?>