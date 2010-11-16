<?php
	echo $ajax->link(
		$html->image('/images/returned.png', array('title' => 'Respingere')),
		$rejectlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>