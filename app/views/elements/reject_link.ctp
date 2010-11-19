<?php
	echo $ajax->link(
		$html->image('/images/returned.png', array('title' => 'Отклонение')),
		$rejectlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>