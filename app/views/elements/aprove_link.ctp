<?php
	echo $ajax->link(
		$html->image('/images/aproved.png', array('title' => 'Aprobare')),
		$aprovelink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>