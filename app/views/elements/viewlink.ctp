<?php
	echo $ajax->link(
		$html->image('/images/view.png', array('title' => 'Vezi')),
		$viewlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>