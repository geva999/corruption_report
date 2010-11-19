<?php
	echo $ajax->link(
		$html->image('/images/edit.png', array('title' => 'Редактировать')),
		$editlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>