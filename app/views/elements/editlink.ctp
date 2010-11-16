<?php
	echo $ajax->link(
		$html->image('/images/edit.png', array('title' => 'Editează')),
		$editlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>