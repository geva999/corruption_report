<?php
class Template extends AppModel {

	var $name = 'Template';
	var $validate = array(
		'name' => array('rule' => 'notempty', 'message' => 'Numele nu poate să fie nul.')
	);

}
?>