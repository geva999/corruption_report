<?php
	echo $ajax->link(
		$html->image('/images/delete.png', array('title' => 'Удалить')),
		$deletelink,
		array('update'=>'content', 'indicator' => 'spinner'),
		'Вы уверены, что хотите удалить этот '.$deletelinkquestion.' ?',
		false);
?>