<?php
	echo $ajax->link(
		$html->image('/images/delete.png', array('title' => 'Şterge')),
		$deletelink,
		array('update'=>'content', 'indicator' => 'spinner'),
		'Sînteţi sigur că doriţi să ştergeţi acest '.$deletelinkquestion.' ?',
		false);
?>